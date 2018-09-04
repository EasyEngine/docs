<?php
/**
 * Generate markdowns and manifest of ee commands.
 *
 * ## EXAMPLES
 *
 *     # Generate markdowns of all commands.
 *     $ ee handbook gen-command
 *
 * @package ee-handbook
 */

define( 'EE_HANDBOOK_PATH', dirname( dirname( __FILE__ ) ) );

class Handbook_Command extends EE_Command{

	/**
	 * Generate markdowns for all commands, generate manifest for commands markdown and generate manifest for handbook.
	 *
	 * ## EXAMPLES
	 *
	 *     $ ee handbook gen-all
	 *
	 * @subcommand gen-all
	 */
	public function gen_all() {
		self::gen_commands();
		self::gen_commands_manifest();
		self::gen_hb_manifest();
		EE::success( 'Generated all doc pages.' );
	}

	/**
	 * Generate markdown file for each ee command.
	 *
	 * ## EXAMPLES
	 *
	 *     $ ee handbook gen-commands
	 *
	 * @subcommand gen-commands
	 */
	public function gen_commands() {
		$ee = self::invoke_ee( 'cli cmd-dump' );

		$bundled_cmds = array();
		foreach ( $ee['subcommands'] as $k => $cmd ) {
			if ( in_array( $cmd['name'], array( 'website', 'api-dump' ) ) ) {
				unset( $ee['subcommands'][ $k ] );
				continue;
			}
			$bundled_cmds[] = $cmd['name'];
		}
		$ee['subcommands'] = array_values( $ee['subcommands'] );
		foreach ( $ee['subcommands'] as $cmd ) {
			self::gen_cmd_pages( $cmd );
		}
		$package_dir      = dirname( __DIR__ ) . '/bin/packages';
		$ee_with_packages = self::invoke_ee( 'cli cmd-dump' );
		foreach ( $ee_with_packages['subcommands'] as $k => $cmd ) {
			if ( in_array( $cmd['name'], array( 'website', 'api-dump' ) )
				|| in_array( $cmd['name'], $bundled_cmds ) ) {
				unset( $ee_with_packages['subcommands'][ $k ] );
			}
		}
		$ee_with_packages['subcommands'] = array_values( $ee_with_packages['subcommands'] );
		foreach ( $ee_with_packages['subcommands'] as $cmd ) {
			self::gen_cmd_pages( $cmd );
		}
		EE::success( 'Generated all command pages.' );
	}

	/**
	 * Update the commands data array with new data
	 */
	private static function update_commands_data( $command, &$commands_data, $parent ) {
		$full       = trim( $parent . ' ' . $command->get_name() );
		$reflection = new \ReflectionClass( $command );
		$repo_url   = '';
		if ( 'help' === substr( $full, 0, 4 )
			|| 'cli' === substr( $full, 0, 3 ) ) {
			$repo_url = 'https://github.com/EasyEngine/easyengine.github.io';
		}
		if ( $reflection->hasProperty( 'when_invoked' ) ) {
			$when_invoked = $reflection->getProperty( 'when_invoked' );
			$when_invoked->setAccessible( true );
			$closure            = $when_invoked->getValue( $command );
			$closure_reflection = new \ReflectionFunction( $closure );
			$static             = $closure_reflection->getStaticVariables();

			if ( isset( $static['callable'][0] ) ) {
				$reflection_class = new \ReflectionClass( $static['callable'][0] );
				$filename         = $reflection_class->getFileName();
				preg_match( '#vendor/([^/]+/[^/]+)#', $filename, $matches );
				if ( ! empty( $matches[1] ) ) {
					$repo_url = 'https://github.com/' . $matches[1];
				}
			} else {
				EE::error( 'No callable for: ' . var_export( $static, true ) );
			}
		}
		$commands_data[ $full ] = array(
			'repo_url' => $repo_url,
		);
		$len                    = count( $commands_data );
		foreach ( $command->get_subcommands() as $subcommand ) {
			$sub_full = trim( $full . ' ' . $subcommand->get_name() );
			self::update_commands_data( $subcommand, $commands_data, $full );
		}
		if ( isset( $sub_full ) && ! $commands_data[ $full ]['repo_url'] && ! empty( $commands_data[ $sub_full ]['repo_url'] ) ) {
			$commands_data[ $full ]['repo_url'] = $commands_data[ $sub_full ]['repo_url'];
		}
	}

	/**
	 * Generate `bin/commands-manifest.json` file from markdown in `commands` directory.
	 *
	 * ## EXAMPLES
	 *
	 *     $ ee handbook gen-commands-manifest
	 *
	 * @subcommand gen-commands-manifest
	 */
	public function gen_commands_manifest() {
		$manifest      = array();
		$paths         = array(
			EE_HANDBOOK_PATH . '/commands/*.md',
			EE_HANDBOOK_PATH . '/commands/*/*.md',
			EE_HANDBOOK_PATH . '/commands/*/*/*.md',
		);
		$commands_data = array();
		 foreach( EE::get_root_command()->get_subcommands() as $command ) {
		 	self::update_commands_data( $command, $commands_data, '' );
		 }
		foreach ( $paths as $path ) {
			foreach ( glob( $path ) as $file ) {
				$slug     = basename( $file, '.md' );
				$cmd_path = str_replace( array( EE_HANDBOOK_PATH . '/commands/', '.md' ), '', $file );
				$title    = '';
				$contents = file_get_contents( $file );
				if ( preg_match( '/^#\s(.+)/', $contents, $matches ) ) {
					$title = $matches[1];
				}
				$parent = null;
				if ( stripos( $cmd_path, '/' ) ) {
					$bits = explode( '/', $cmd_path );
					array_pop( $bits );
					$parent = implode( '/', $bits );
				}
				$manifest[ $cmd_path ] = array(
					'title'           => $title,
					'slug'            => $slug,
					'cmd_path'        => $cmd_path,
					'parent'          => $parent,
					'markdown_source' => sprintf( 'https://github.com/EasyEngine/easyengine.github.io/blob/master/commands/%s.md', $cmd_path ),
				);
				if ( ! empty( $commands_data[ $title ] ) ) {
					$manifest[ $cmd_path ] = array_merge( $manifest[ $cmd_path ], $commands_data[ $title ] );
				}
			}
		}
		file_put_contents( EE_HANDBOOK_PATH . '/bin/commands-manifest.json', json_encode( $manifest, JSON_PRETTY_PRINT ) );
		$count = count( $manifest );
		EE::success( "Generated commands-manifest.json of {$count} commands" );
	}

	/**
	 * Generate `bin/handbook-manifest.json` file from markdown in `handbook` directory.
	 *
	 * ## EXAMPLES
	 *
	 *     $ ee handbook gen-hb-manifest
	 *
	 * @subcommand gen-hb-manifest
	 */
	public function gen_hb_manifest() {
		$manifest      = array();
		$paths         = array(
			EE_HANDBOOK_PATH . '/handbook/*.md',
			EE_HANDBOOK_PATH . '/handbook/*/*.md',
			EE_HANDBOOK_PATH . '/handbook/*/*/*.md',
		);
		$commands_data = array();
		foreach ( $paths as $path ) {
			foreach ( glob( $path ) as $file ) {
				$slug     = basename( $file, '.md' );
				$cmd_path = str_replace( array( EE_HANDBOOK_PATH . '/handbook/', '.md' ), '', $file );
				$title    = '';
				$contents = file_get_contents( $file );
				if ( preg_match( '/^#\s(.+)/', $contents, $matches ) ) {
					$title = $matches[1];
				}
				$parent = null;
				if ( stripos( $cmd_path, '/' ) ) {
					$bits = explode( '/', $cmd_path );
					array_pop( $bits );
					$parent = implode( '/', $bits );
				}
				$manifest[ $cmd_path ] = array(
					'title'           => $title,
					'slug'            => $slug,
					'cmd_path'        => $cmd_path,
					'parent'          => $parent,
					'markdown_source' => sprintf( 'https://github.com/EasyEngine/easyengine.github.io/blob/master/handbook/%s.md', $cmd_path ),
				);
				if ( ! empty( $commands_data[ $title ] ) ) {
					$manifest[ $cmd_path ] = array_merge( $manifest[ $cmd_path ], $commands_data[ $title ] );
				}
			}
		}
		file_put_contents( EE_HANDBOOK_PATH . '/bin/handbook-manifest.json', json_encode( $manifest, JSON_PRETTY_PRINT ) );
		$count = count( $manifest );
		EE::success( "Generated handbook-manifest.json" );
	}

	private static function gen_cmd_pages( $cmd, $parent = array() ) {
		$parent[] = $cmd['name'];
		static $params;
		if ( ! isset( $params ) ) {
			$params = self::invoke_ee( 'cli param-dump' );
		}
		$binding                = $cmd;
		$binding['synopsis']    = implode( ' ', $parent );
		$binding['path']        = implode( '/', $parent );
		$path                   = '/commands/';
		$binding['breadcrumbs'] = '[Commands](' . $path . ')';
		foreach ( $parent as $i => $p ) {
			$path .= $p . '/';
			if ( $i < ( count( $parent ) - 1 ) ) {
				$binding['breadcrumbs'] .= " &raquo; [{$p}]({$path})";
			} else {
				$binding['breadcrumbs'] .= " &raquo; {$p}";
			}
		}
		$binding['has-subcommands'] = isset( $cmd['subcommands'] ) ? array( true ) : false;
		if ( $cmd['longdesc'] ) {
			$docs = $cmd['longdesc'];
			$docs = htmlspecialchars( $docs, ENT_COMPAT, 'UTF-8' );
			// decrease header level
			$docs = preg_replace( '/^## /m', '### ', $docs );
			// escape `--` so that it doesn't get converted into `&mdash;`
			$docs = preg_replace( '/^(\[?)--/m', '\1\--', $docs );
			$docs = preg_replace( '/^\s\s--/m', '  \1\--', $docs );
			// Remove wordwrapping from docs
			// Match words, '().,;', and --arg before/after the newline
			$bits        = explode( "\n", $docs );
			$in_yaml_doc = $in_code_bloc = false;
			for ( $i = 0; $i < count( $bits ); $i++ ) {
				if ( ! isset( $bits[ $i ] ) || ! isset( $bits[ $i + 1 ] ) ) {
					continue;
				}
				if ( '---' === $bits[ $i ] || '\---' === $bits[ $i ] ) {
					$in_yaml_doc = ! $in_yaml_doc;
				}
				if ( '```' === $bits[ $i ] ) {
					$in_code_bloc = ! $in_code_bloc;
				}
				if ( $in_yaml_doc || $in_code_bloc ) {
					continue;
				}
				if ( preg_match( '#([\w\(\)\.\,\;]|[`]{1})$#', $bits[ $i ] )
					&& preg_match( '#^([\w\(\)\.\,\;`]|\\\--[\w]|[`]{1})#', $bits[ $i + 1 ] ) ) {
					$bits[ $i ] .= ' ' . $bits[ $i + 1 ];
					unset( $bits[ $i + 1 ] );
					--$i;
					$bits = array_values( $bits );
				}
			}
			$docs = implode( "\n", $bits );
			// hack to prevent double encoding in code blocks
			$docs              = preg_replace( '/ &lt; /', ' < ', $docs );
			$docs              = preg_replace( '/ &gt; /', ' > ', $docs );
			$docs              = preg_replace( '/ &lt;&lt;/', ' <<', $docs );
			$docs              = preg_replace( '/&quot;/', '"', $docs );
			$docs              = preg_replace( '/ee&gt; /', 'ee> ', $docs );
			$docs              = preg_replace( '/=&gt;/', '=>', $docs );
			$global_parameters = <<<EOT
| **Argument**    | **Description**              |
|:----------------|:-----------------------------|
EOT;
			foreach ( $params as $param => $meta ) {
				if ( false === $meta['runtime']
					|| empty( $meta['desc'] )
					|| ! empty( $meta['deprecated'] ) ) {
					continue;
				}
				$param_arg = '--' . $param;
				if ( ! empty( $meta['runtime'] ) && true !== $meta['runtime'] ) {
					$param_arg .= $meta['runtime'];
				}
				if ( 'color' === $param ) {
					$param_arg = '--[no-]color';
				}
				$global_parameters .= PHP_EOL . '| `' . str_replace( '|', '\\|', $param_arg ) . '` | ' . str_replace( '|', '\\|', $meta['desc'] ) . ' |';
			}
			// Replace Global parameters with a nice table
			if ( $binding['has-subcommands'] ) {
				$replace_global = '';
			} else {
				$replace_global = '$1' . PHP_EOL . PHP_EOL . $global_parameters;
			}
			$docs            = preg_replace( '/(#?## GLOBAL PARAMETERS).+/s', $replace_global, $docs );
			$binding['docs'] = $docs;
		}
		$path = dirname( __DIR__ ) . "/commands/" . $binding['path'];
		if ( ! is_dir( dirname( $path ) ) ) {
			mkdir( dirname( $path ) );
		}
		file_put_contents( "$path.md", self::render( 'subcmd-list.mustache', $binding ) );
		EE::log( 'Generated /commands/' . $binding['path'] . '/' );
		if ( ! isset( $cmd['subcommands'] ) )
			return;
		foreach ( $cmd['subcommands'] as $subcmd ) {
			self::gen_cmd_pages( $subcmd, $parent );
		}
	}

	/**
	 * Parse PHPDoc into a structured representation.
	 *
	 * @param string $docblock
	 *
	 * @return array
	 */
	private static function parse_docblock( $docblock ) {
		$ret        = array(
			'description' => '',
			'parameters'  => array(),
		);
		$extra_line = '';
		$in_param   = false;
		foreach ( preg_split( "/(\r?\n)/", $docblock ) as $line ) {
			if ( preg_match( '/^(?=\s+?\*[^\/])(.+)/', $line, $matches ) ) {
				$info = trim( $matches[1] );
				$info = preg_replace( '/^(\*\s+?)/', '', $info );
				if ( $in_param ) {
					list( $param, $key ) = $in_param;
					$ret['parameters'][ $param_name ][ $key ][2] .= PHP_EOL . $info;
					if ( '}' === substr( $info, -1 ) ) {
						$in_param = false;
					}
				} else if ( $info[0] !== "@" ) {
					$ret['description'] .= PHP_EOL . "{$extra_line}{$info}";
				} else {
					preg_match( '/@(\w+)/', $info, $matches );
					$param_name = $matches[1];
					$value      = str_replace( "@$param_name ", '', $info );
					if ( ! isset( $ret['parameters'][ $param_name ] ) ) {
						$ret['parameters'][ $param_name ] = array();
					}
					$ret['parameters'][ $param_name ][] = preg_split( '/[\s]+/', $value, 3 );
					end( $ret['parameters'][ $param_name ] );
					$key = key( $ret['parameters'][ $param_name ] );
					reset( $ret['parameters'][ $param_name ] );
					if ( ! empty( $ret['parameters'][ $param_name ][ $key ][2] )
						&& '{' === substr( $ret['parameters'][ $param_name ][ $key ][2], -1 ) ) {
						$in_param = array( $param_name, $key );
					}
				}
				$extra_line = '';
			} else {
				$extra_line .= PHP_EOL;
			}
		}
		$ret['description'] = str_replace( '\/', '/', trim( $ret['description'], PHP_EOL ) );
		$bits               = explode( PHP_EOL, $ret['description'] );
		$short_desc         = array( array_shift( $bits ) );
		while ( isset( $bits[0] ) && ! empty( $bits[0] ) ) {
			$short_desc[] = array_shift( $bits );
		}
		$ret['short_description'] = trim( implode( ' ', $short_desc ) );
		$long_description         = trim( implode( PHP_EOL, $bits ), PHP_EOL );
		$ret['long_description']  = $long_description;
		return $ret;
	}

	private static function invoke_ee( $args ) {

		ob_start();
		EE::run_command( explode(' ', $args ) );
		$json = ob_get_clean();

		return json_decode( $json, true );
	}

	private static function render( $path, $binding ) {
		$m        = new Mustache_Engine;
		$template = file_get_contents( EE_HANDBOOK_PATH . "/templates/$path" );
		return $m->render( $template, $binding );
	}
}
