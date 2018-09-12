easyengine/handbook
===============

These files comprise the EasyEngine handbook ([docs.easyengine.io/handbook](https://docs.easyengine.io/handbook/)) and EasyEngine commands directory ([docs.easyengine.io/commands](https://docs.easyengine.io/cli/commands/)).

The documentation is located in GitHub to enable a pull request-based editing workflow. Long-form documentation can be edited directly. Command pages are generated dynamically from the EasyEngine codebase using the `ee handbook gen_commands` series of commands. `ee handbook gen-all` will regenerate all of the command pages and handbook pages.

All documentation is imported automatically into docs.easyengine.io in a two step process:

1. WordPress reads `commands-manifest.json` and `handbook-manifest.json` to understand all pages that need to be created.
2. Each WordPress page has a `markdown_source` attribute specifying a Markdown file to be fetched, converted to HTML, and saved in the database.

For docs.easyengine.io, the import process is running a WP Cron job on every push to github repo.