---
ID: 42092
post_title: Convert qcow2 to raw format
author: Rahul Bansal
post_excerpt: >
  Converting qcow2 disk format images to
  raw disk format for existing KVM guests
  for better Disk I/O performance
layout: page
permalink: >
  https://easyengine.io/tutorials/kvm/convert-qcow2-to-raw-format/
published: true
post_date: 2013-07-10 18:41:19
---
This guide is for existing VM's.
<h3>Backup VM config</h3>
<pre>virsh dumpxml &lt;vmname&gt; &gt; ~/vmname.xml</pre>
Replace <code>vmname</code> with Virtual Machine (Domain) name. You can find correct name by running <code>virsh list --all</code>
<h3>Image Conversion</h3>
<h4>Find path of existing image (in qcow2) format</h4>
<pre class="no-highlight">virsh dumpxml &lt;vmname&gt; | grep file</pre>
Will show something like:
<pre class="no-highlight">    &lt;disk type='file' device='disk'&gt;
      &lt;source file='<strong>/var/lib/libvirt/images/ubuntu-kvm/tmpjaAefX.qcow2</strong>'/&gt;</pre>
<h4>Conversion</h4>
Sample command is:
<pre class="no-highlight">qemu-img convert {image_name}.qcow2 {image_name}.raw</pre>
So in this case, it will be:
<pre class="no-highlight">qemu-img convert /var/lib/libvirt/images/ubuntu-kvm/tmpjaAefX.qcow2 /var/lib/libvirt/images/ubuntu-kvm/tmpjaAefX.raw</pre>
At this point conversion is complete.
<h3>Edit VM Configuration</h3>
<h3>Edit VM Config</h3>
Run following command to open editor.
<pre>virsh edit &lt;vmname&gt;</pre>
Find lines like below:
<pre>    &lt;disk type='file' device='disk'&gt;
      &lt;driver name='qemu' type='<strong>qcow2</strong>'/&gt;
      &lt;source file='/var/lib/libvirt/images/ubuntu-kvm/tmpU2z98r.<strong>qcow2</strong>'/&gt;
      &lt;target dev='vda' bus='virtio'/&gt;
      &lt;address type='pci' domain='0x0000' bus='0x00' slot='0x05' function='0x0'/&gt;
    &lt;/disk&gt;</pre>
Replace<code>qcow2</code> with<code>raw</code> Ain 2 places highlighted above.<code></code>

Your update config will look like below:
<pre>    &lt;disk type='file' device='disk'&gt;
      &lt;driver name='qemu' type='<strong>raw</strong>'/&gt;
      &lt;source file='/var/lib/libvirt/images/ubuntu-kvm/tmpU2z98r.<strong>raw</strong>'/&gt;
      &lt;target dev='vda' bus='virtio'/&gt;
      &lt;address type='pci' domain='0x0000' bus='0x00' slot='0x05' function='0x0'/&gt;
    &lt;/disk&gt;</pre>
Save your changes and exit editor.
<h4>Start VM</h4>
Run following command:
<pre>virsh start &lt;vmname&gt;</pre>
At this point you can run your disk I/O benchmarks again to check speed.