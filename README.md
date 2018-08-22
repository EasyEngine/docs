# easyengine.github.io

[![Build Status](https://travis-ci.org/EasyEngine/easyengine.github.io.svg?branch=source)](https://travis-ci.org/EasyEngine/easyengine.github.io)

GitBook documentation for the [EasyEngine](https://easyengine.io) project.

# Publishing

Any changes made to the documentation will automatically get published to [easyengine.github.io](https://easyengine.github.io)
via Travis CI once the changes are merged into the `source` branch.

# Requirements

* npm

# Preparation

First, install GitBook's CLI with the following commands:

1. `npm install`
2. `npm run docs:prepare`

# Development

A local development server can be started with `npm run docs:watch`. This server
will watch for local changes and reflect them in the build directory. The
development server also hosts the website at `localhost:4000`.

Alternatively, a static site can be built by running `npm run docs:build`.

# Branch Explanation

This repo has a slightly unconventional branching setup.

Because this repo is intended to host an organization webpage, then per
[GitHub's requirements](https://help.github.com/articles/user-organization-and-project-pages/)
the rendered website MUST appear on the `master` branch. Since the `master`
branch can no longer be used to hold the source, a separate branch must be made
for that, which in this case is called `source`.
