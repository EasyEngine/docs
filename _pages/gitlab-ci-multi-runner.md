---
ID: 141391
post_title: gitlab-ci-multi-runner
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: >
  https://easyengine.io/tutorials/gitlab/gitlab-ci-multi-runner/
published: true
post_date: 2016-12-28 22:58:41
---
We prefer Gitlab Multi Runner

Link: <a href="https://docs.gitlab.com/runner/install/linux-repository.html">https://docs.gitlab.com/runner/install/linux-repository.html</a>
<h2>Install</h2>
<pre class="no-highlight">#Install Docker
curl -sSL https://get.docker.com/ | sh

# For Debian/Ubuntu
curl -L https://packages.gitlab.com/install/repositories/runner/gitlab-ci-multi-runner/script.deb.sh | sudo bash

# apt-pinning

cat &gt; /etc/apt/preferences.d/pin-gitlab-runner.pref &lt;&lt;EOF
Explanation: Prefer GitLab provided packages over the Debian native ones
Package: gitlab-ci-multi-runner
Pin: origin packages.gitlab.com
Pin-Priority: 1001
EOF

# For Debian/Ubuntu
sudo apt-get install gitlab-ci-multi-runner

</pre>
<h2>Register</h2>
Run following command
<pre class="no-highlight">sudo gitlab-ci-multi-runner register</pre>
Sample output
<pre>Please enter the gitlab-ci coordinator URL (e.g. https://gitlab.com )
https://gitlab.com
Please enter the gitlab-ci token for this runner
xxx
Please enter the gitlab-ci description for this runner
my-runner
INFO[0034] fcf5c619 Registering runner... succeeded
Please enter the executor: shell, docker, docker-ssh, ssh?
docker
Please enter the Docker image (eg. ruby:2.1):
ruby:2.1
INFO[0037] Runner registered successfully. Feel free to start it, but if it's
running already the config should be automatically reloaded!</pre>
<h2>Update</h2>
<pre class="no-highlight">sudo apt-get update
sudo apt-get install gitlab-ci-multi-runner</pre>
For more help, please <a href="https://docs.gitlab.com/runner/install/linux-repository.html">check official doc</a>.