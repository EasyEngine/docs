---
ID: 141965
post_title: >
  WordPress with Kubernetes using Minikube
  and Helm on localhost (MacOS)
author: Rahul Bansal
post_excerpt: >
  Setup WordPress locally on MacOS using
  Kubernetes, Minikube, Helm. Also covers
  VirtualBox, Xhyve and MacOS native
  Hyperkit hypervisor.
layout: page
permalink: >
  https://easyengine.io/tutorials/docker-wordpress/kubernetes/minikube-helm-localhost-macos/
published: true
post_date: 2017-09-28 14:27:09
---
<h2>Install Kubernetes CLI</h2>
kubernetes cli is a command line client required to interact with a kubernetes cluster. You can download, install it using:
<pre>brew install kubectl</pre>
<h2>Install MiniKube</h2>
<a href="https://github.com/kubernetes/minikube">MiniKube</a> can create a single-node Kubernetes cluster locally using a virtual machine created with VirtualBox.

This is useful for developing and testing locally with Kubernetes.
<pre>brew cask install minikube</pre>
<h2>Install Virtual Machine</h2>
To set up a kubernetes cluster locally, Minikube will need a hypervisor (virtual machine). There are many options for each platform.
<h3>Virtualbox</h3>
The easiest to setup and get working. Run the following command to download and install VirtualBox.
<pre> brew cask install virtualbox</pre>
Virtualbox is default driver for Minikube. So to start a kubernetes cluster, just run:
<pre>minikube start</pre>
Above command will automatically download virtual machine images and create a virtual machine.
<h3>Xhyve</h3>
If you do not need VirtualBox for other purposes, installing it for kubernetes localhost development could be overkill.

There is a minimalistic alternative. You can install it using:
<pre>brew install xhyve docker-machine-driver-xhyve</pre>
With, xhyve, you need to start minikube differently:
<pre>minikube start --vm-driver=xhyve</pre>
<h4>Hyperkit</h4>
MacOS has native hypervisor support. Unfortunately, its a bit tricky to get working. At the time of writing, we couldn't get DNS issues resolved.

Assuming you have Go language installed correctly, you need to run following to build docker-machine driver plugin for hyperkit. It's required later by Minikube but pre-compiled binaries were not found.

Following commands may take from few minutes to even an hour depending on your machine power and Internet speed.
<pre>git clone https://github.com/kubernetes/minikube $GOPATH/src/k8s.io/minikube
cd $GOPATH/src/k8s.io/minikube
make out/docker-machine-driver-hyperkit
cp out/docker-machine-driver-hyperkit $GOPATH/bin/docker-machine-driver-hyperkit
sudo chown root:wheel $GOPATH/bin/docker-machine-driver-hyperkit
sudo chmod u+s $GOPATH/bin/docker-machine-driver-hyperkit</pre>
With, hyperkit, you need to start minikube differently:
<pre>minikube start --vm-driver=hyperkit</pre>
<h2>Open kubernetes Dashboard (WebUI)</h2>
No matter how you start minikube, as in using a driver, you can run <code>minikube dashboard</code>  command to open kubernetes dashboard web interface.

It's advisable to open kubernetes dashboard at this point to verify you have followed along correctly.
<h2>Install Helm</h2>
Helm is package manager for kubernetes. In kubernetes, application of different types can be packed and distributed using helm. One example is <a href="https://github.com/kubernetes/charts/tree/master/stable/wordpress">WordPress</a>.

To install helm, run following:
<pre>brew install kubernetes-helm</pre>
Helm has two parts: a client (<code>helm</code>) and a server (<code>tiller</code>).

The server will start in current kubernetes cluster. You can verify if current kubernetes context is <strong>minikube</strong> by running <code>kubectl config current-context</code>

Next, you can start helm by running command
<pre>helm init</pre>
<h2>Install WordPress using Helm</h2>
We will install <a href="https://github.com/kubernetes/charts/tree/master/stable/wordpress">official WordPress chart</a> using following command:
<pre>helm install --set serviceType=NodePort --name wp-k8s stable/wordpress</pre>
Above will setup a fresh WordPress site up and running.

To find out URL of WordPress site, run following three commands as it is.
<pre> export NODE_PORT=$(kubectl get --namespace wordpress -o jsonpath="{.spec.ports[0].nodePort}" services wp-k8s-wordpress)
 export NODE_IP=$(kubectl get nodes --namespace wordpress -o jsonpath="{.items[0].status.addresses[0].address}")
 echo http://$NODE_IP:$NODE_PORT/admin</pre>
The default WordPress admin username is <code>user</code> .

For password, please run following command:
<pre> echo Password: $(kubectl get secret --namespace wordpress wp-k8s-wordpress -o jsonpath="{.data.wordpress-password}" | base64 --decode)</pre>
Tets if you can log into the WordPress site and use it by publishing some posts and uploading some media.
<h2>Other Helm Commands</h2>
Run <code>helm help</code> to see all commands. Below are one which you need frequently.
<ul>
 	<li>List releases - <code>helm list</code></li>
 	<li>Detele a release - <code>helm delete my-release-name</code></li>
</ul>
<h2><strong>Helm Concepts</strong></h2>
Following is copied with some changes from <a href="https://docs.helm.sh/using_helm/#three-big-concepts">https://docs.helm.sh/using_helm/#three-big-concepts</a>
<ol>
 	<li>A <em>Chart</em> is a Helm package. It contains all of the resource definitions necessary to run an application, tool, or service inside of a Kubernetes cluster. Think of it like the Kubernetes equivalent of a Homebrew formula, an Apt dpkg, or a Yum RPM file.</li>
 	<li>A <em>Repository</em> is a place where charts can be collected and shared. It’s like Composer's packagist.org or the Fedora Package Database, but for Kubernetes packages.</li>
 	<li>A <em>Release</em> is an instance of a chart running in a Kubernetes cluster. One chart can often be installed many times into the same cluster. And each time it is installed, a new release is created. Consider a MySQL chart. If you want two databases running in your cluster, you can install that chart twice. Each one will have its own release, which will, in turn, have its own release name. A release is not a chart version.</li>
</ol>
<h2>References</h2>
<ol>
 	<li><a href="https://deliciousbrains.com/running-wordpress-kubernetes-cluster/">DeliciousBrains article</a></li>
 	<li>Kubernetes Docs - <a href="https://kubernetes.io/docs/">https://kubernetes.io/docs/</a></li>
 	<li>MiniKube - <a href="https://github.com/kubernetes/minikube">https://github.com/kubernetes/minikube</a></li>
 	<li>Helm Docs - <a href="https://docs.helm.sh/using_helm/#quickstart-guide">https://docs.helm.sh/</a></li>
</ol>