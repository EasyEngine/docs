---
ID: 42077
post_title: 'Enable virtio for existing VM&#8217;s'
author: Rahul Bansal
post_excerpt: "Enable virtio on existing KVM guest's for enhanced disk i/o performance"
layout: page
permalink: >
  https://easyengine.io/tutorials/kvm/enable-virtio-existing-vms/
published: true
post_date: 2013-07-10 18:00:22
---
On one of our host machine, we get around 70MB/second disk write speed, but KVM guest machine was giving us around 18MB/s write performance.

At that point we came to know about virtio driver. Here is guide to enable virtio
<h3>Backup VM config</h3>
<pre class="no-highlight">virsh dumpxml &lt;vmname&gt; &gt; ~/vmname.xml</pre>
Replace <code>vmname</code> with Virtual Machine (Domain) name. You can find correct name by running <code>virsh list --all</code>
<h3>Edit VM Config</h3>
Run following command to open editor.
<pre class="no-highlight">virsh edit &lt;vmname&gt;</pre>
Find lines like below:
<pre class="no-highlight">    &lt;disk type='file' device='disk'&gt;
      &lt;driver name='qemu' type='qcow2'/&gt;
      &lt;source file='/var/lib/libvirt/images/ubuntu-kvm/tmpU2z98r.qcow2'/&gt;
<strong>      &lt;target dev='hda' bus='ide'/&gt;</strong>
      &lt;address type='drive' controller='0' bus='0' unit='0'/&gt;
    &lt;/disk&gt;</pre>
<strong>Make following changes:</strong>
<ol>
	<li>Replace<code>hda</code> with<code>vda</code> AND<code>ide</code> with <code>virtio</code></li>
	<li>Remove following line: <code>&lt;address type='drive' controller='0' bus='0' unit='0'/&gt;</code></li>
	<li>Add <code>cache='none' io='native'</code> option to <code>driver</code>.</li>
</ol>
Your update config will look like below:
<pre class="no-highlight">    &lt;disk type='file' device='disk'&gt;
      &lt;driver name='qemu' type='qcow2' cache='none' io='native'/&gt;
      &lt;source file='/var/lib/libvirt/images/ubuntu-kvm/tmpU2z98r.qcow2'/&gt;
      &lt;target dev='vda' bus='virtio'/&gt;
    &lt;/disk&gt;</pre>
Save your changes and exit editor.
<h3>Changes to Guest VM's filesystem</h3>
I am not sure if this step is necessary but one <a href="http://www.grosseosterhues.com/2011/03/migrate-kvm-ide-to-virtio/">tutorial</a> mentions this. I did not try outcome without this step as VM's I was playing with has some critical data.

Anyway, login to Guest VM's shell and open in editor <code>vim /etc/fstab</code>

Fine lines like <code>/dev/sdX</code>. Replace <code>'s'</code> with <code>'v'</code>.

So <code>/dev/sda1</code> will become <code>/dev/vda1</code> and <code>/dev/sda2</code> will become <code>/dev/vda2</code> and so on.
<h3>For changes to reflect</h3>
Shutdown Guest VM for its shell. You can use command <code>shutdown 0</code>

Next, from Host machine, run following commands:
<pre class="no-highlight">virsh destroy &lt;vmname&gt;
virsh start &lt;vmname&gt;</pre>
virsh reboot won't work.

At this point you can run your disk I/O benchmarks again to check speed.

In our case performance shoot-up from 18MB/s to 40.8 MB/s.