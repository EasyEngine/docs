---
ID: 79364
post_title: Vagrant
author: Rahul Bansal
post_excerpt: ""
layout: page
permalink: https://easyengine.io/tutorials/vagrant/
published: true
post_date: 2015-01-29 19:44:37
---
We use Vagrant as command-line virtualbox wrapper. Mainly to test EasyEngine builds which require fresh OS.

<a href="https://www.vagrantup.com/downloads.html">You can get Vagrant for your OS from this page</a>.
<h3>Getting Started</h3>
Create a folder for your work environment and change into it.
<pre>mkdir vagrant-work &amp;&amp; cd vagrant-work</pre>
Create a Ubuntu 14.04 LTS 64-bit box
<pre>vagrant init ubuntu/trusty64</pre>
Above command quickly initializes a vagrantfile in your vagrant-work folder.

Next, we need to start (boot) it by running command:
<pre>vagrant up</pre>
Above command may take longer for first time as entire OS image gets downloaded behind the scene!

Next, log into the box via SSH!
<pre>vagrant ssh</pre>
<h2>Forwarding Port 80 from Mac</h2>
First, we need to configure vagrantfile to redirect traffic from 8080 to 80 inside localhost:
<pre>config.vm.forward_port 80, 8080</pre>
<h3>Mac OS - till Maverick</h3>
If you wish to dedicate port 80 to web-server running inside vagrant i.e. in virtual machine, please run follow command on Mac OS terminal:
<pre>sudo ipfw add 100 fwd 127.0.0.1,8080 tcp from any to me 80</pre>
Above will forward any traffic on host machine's port 80 to port localhost's 8080.

You can make this permanent as well by following <a href="http://www.dmuth.org/node/1404/web-development-port-80-and-443-vagrant">instructions from Douglas Muth</a>.

&nbsp;
<h3>Mac OS - Yosemite onwards</h3>
Install a vagrant plugin
<pre>vagrant plugin install vagrant-triggers</pre>
Add following to vagrant config file before end
<pre class="no-highlight">config.trigger.after [:provision, :up, :reload] do
      system('echo "
        rdr pass on lo0 inet proto tcp from any to 127.0.0.1 port 80 -&gt; 127.0.0.1 port 8080   " | sudo pfctl -ef - &gt; /dev/null 2&gt;&amp;1; echo "==&gt; Fowarding Ports: 80 -&gt; 8080 &amp; Enabling pf"')  
  end

  config.trigger.after [:halt, :destroy] do
    system("sudo pfctl -df /etc/pf.conf &gt; /dev/null 2&gt;&amp;1; echo '==&gt; Removing Port Forwarding &amp; Disabling pf'")
  end</pre>
Above vagrant config is taken from <a href="https://www.danpurdy.co.uk/web-development/osx-yosemite-port-forwarding-for-vagrant/">here</a>.