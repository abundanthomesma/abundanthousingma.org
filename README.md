# abundanthousingma.org

All-in-one development stack, provisioning playbooks, theme development, and deployment mechanisms for the [Abundant Housing MA website](https://abundanthousingma.org).

We make use of [Trellis](https://roots.io/trellis/) (local & public server provisioning), [Bedrock](https://roots.io/bedrock/) (WordPress boilerplate), and [Sage](https://roots.io/sage/) (WordPress starter theme) to make things really shine.

## Requirements

Make sure all dependencies have been installed before moving on:

- [Virtualbox](https://www.virtualbox.org/wiki/Downloads) >= 4.3.10
- [Vagrant](https://www.vagrantup.com/downloads.html) = 2.1.0
- [trellis-cli](https://github.com/roots/trellis-cli)

**Windows user?** [Read the Windows getting started docs](https://roots.io/docs/getting-started/windows/#working-with-trellis) for slightly different installation instructions.

## Local development setup

All commands below are meant to be run from the `trellis/` directory.

### Using trellis-cli

1. Review the automatically created site in `group_vars/development/wordpress_sites.yml`
2. Customize settings if necessary

Start the Vagrant virtual machine:

```bash
trellis up
```

## Deploying to remote servers

### Using trellis-cli

For `<environment>`, the available values are:

* `production`

Deploy a site:

```bash
trellis deploy <environment> abundanthousingma.org
```

Rollback a deploy:

```bash
trellis rollback <environment> abundanthousingma.org
```
