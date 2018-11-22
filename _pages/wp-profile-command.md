---
ID: 141284
post_title: wp profile command
author: Rahul Bansal
post_excerpt: >
  Using `wp profile` to find out what
  makes your WordPress website slow
layout: page
permalink: >
  https://easyengine.io/tutorials/wpcli/wp-profile-command/
published: true
post_date: 2016-10-09 15:31:16
---
This is how we use <a href="https://runcommand.io/wp/profile/">wp profile</a>, a premium <a href="http://wp-cli.org/">wp-cli</a> command. This command is lifesaver.
<h2>Usage</h2>
Commands

<code>wp profile</code>

<strong>Output</strong>
<pre class="no-highlight">+-----------+---------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-------------+
| stage     | time    | query_tim | query_cou | cache_rat | cache_hit | cache_mis | hook_time | hook_coun | request_t | request_cou |
|           |         | e         | nt        | io        | s         | ses       |           | t         | ime       | nt          |
+-----------+---------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-------------+
| <strong>bootstrap</strong> | <strong>5.3334s</strong> | 0.5977s   | 6643      | 35.25%    | 7227      | 13275     | 3.8516s   | 31334     | 0s        | 0           |
| main_quer | 0.0159s | 0.0005s   | 4         | 95.56%    | 43        | 2         | 0.0111s   | 157       | 0s        | 0           |
| y         |         |           |           |           |           |           |           |           |           |             |
| template  | 1.7506s | 0.0275s   | 221       | 88.82%    | 1533      | 193       | 0.7102s   | 19882     | 0s        | 0           |
+-----------+---------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-------------+
| total     | 7.0999s | 0.6257s   | 6868      | 73.21%    | 8803      | 13470     | 4.5729s   | 51373     | 0s        | 0           |
+-----------+---------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-----------+-------------+</pre>
As you can see <code>bootstrap</code> stage is taking most time!

So run <code>wp profile --stage=bootstrap </code>next

<strong>Output</strong>
<pre class="no-highlight">+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+---------------+
| hook              | time    | query_time | query_count | cache_ratio | cache_hits | cache_misses | request_time | request_count |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+---------------+
|                   | 0.0794s | 0.0016s    | 1           | 25%         | 1          | 3            | 0s           | 0             |
| muplugins_loaded  | 0.0003s | 0s         | 0           | 50%         | 1          | 1            | 0s           | 0             |
|                   | 1.0627s | 0.0016s    | 22          | 72.83%      | 185        | 69           | 0s           | 0             |
| plugins_loaded    | 0.0845s | 0.0031s    | 15          | 94.49%      | 120        | 7            | 0s           | 0             |
|                   | 0.0005s | 0s         | 0           | 100%        | 4          | 0            | 0s           | 0             |
| setup_theme       | 0s      | 0s         | 0           |             | 0          | 0            | 0s           | 0             |
|                   | 0.0277s | 0s         | 0           | 100%        | 58         | 0            | 0s           | 0             |
| <strong>after_setup_theme | 5.3204s</strong> | 0.5621s    | 6592        | 33.42%      | 6617       | 13180        | 0s           | 0             |
|                   | 0.0001s | 0s         | 0           |             | 0          | 0            | 0s           | 0             |
| init              | 0.3526s | 0.0124s    | 10          | 95.51%      | 234        | 11           | 0s           | 0             |
|                   | 0.001s  | 0.0001s    | 1           | 60%         | 3          | 2            | 0s           | 0             |
| wp_loaded         | 0.0028s | 0.0001s    | 2           | 66.67%      | 4          | 2            | 0s           | 0             |
|                   | 0.0253s | 0s         | 0           |             | 0          | 0            | 0s           | 0             |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+---------------+
| total             | 6.9573s | 0.5811s    | 6643        | 69.79%      | 7227       | 13275        | 0s           | 0             |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+---------------+</pre>
You can see <code>after_setup_theme</code> takes almost 5 seconds!

So let's run <code>wp profile --hook=after_setup_theme</code> next

<strong>Output</strong>
<pre class="no-highlight">+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+--------------------+
| callback          | time    | query_time | query_count | cache_ratio | cache_hits | cache_misses | request_time | request_count      |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+--------------------+
| WooCommerce-&gt;setu | 0.0008s | 0s         | 0           | 100%        | 6          | 0            | 0s           | 0                  |
| p_environment()   |         |            |             |             |            |              |              |                    |
| MC4WP_Integration | 0.0028s | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| _Manager-&gt;initial |         |            |             |             |            |              |              |                    |
| ize()             |         |            |             |             |            |              |              |                    |
| rtp_wc_add_states | 0s      | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| _filter()         |         |            |             |             |            |              |              |                    |
| rtp_referral_link | 0.0001s | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| _rewrite_rules()  |         |            |             |             |            |              |              |                    |
| rtp_session_start | 0s      | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| ()                |         |            |             |             |            |              |              |                    |
| <strong>rtpanel_setup()   | 4.6487s</strong> | 0.5885s    | 6591        | 33.4%       | 6609       | 13179        | 0s           | 0                  |
| WooCommerce-&gt;incl | 0.0021s | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| ude_template_func |         |            |             |             |            |              |              |                    |
| tions()           |         |            |             |             |            |              |              |                    |
| wc_template_debug | 0.0004s | 0.0001s    | 1           | 66.67%      | 2          | 1            | 0s           | 0                  |
| _mode()           |         |            |             |             |            |              |              |                    |
| WPSEO_Sitemaps-&gt;r | 0s      | 0s         | 0           |             | 0          | 0            | 0s           | 0                  |
| educe_query_load( |         |            |             |             |            |              |              |                    |
| )                 |         |            |             |             |            |              |              |                    |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+--------------------+
| total             | 4.6548s | 0.5886s    | 6592        | 66.69%      | 6617       | 13180        | 0s           | 0                  |
+-------------------+---------+------------+-------------+-------------+------------+--------------+--------------+--------------------+</pre>
Looks like `rtpanel_setup` function is the culprit here!

This function is from our own rtPanel theme. We checked function body and found a for-loop at a wrong place!

Can't imagine how much time it would have taken to debug this without WP-CLI profile command.