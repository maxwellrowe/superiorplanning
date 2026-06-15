# Superior Planning Theme

## Deployment

This repo includes a GitHub Actions workflow at `.github/workflows/deploy-dev.yml` that deploys the WordPress theme to a WP Engine development environment through the WP Engine SSH Gateway.

### Trigger

The deployment runs automatically when code is pushed to the `dev` branch.

### What gets deployed

Only the theme directory below is deployed:

`wp-content/themes/superior-planning/`

It is deployed to the same path on the WP Engine environment:

`wp-content/themes/superior-planning/`

This workflow does not deploy WordPress core, uploads, database files, or `wp-config.php`.

### Required GitHub secrets

Add these repository secrets in GitHub for `maxwellrowe/superiorplanning`:

- `WPE_SSHG_KEY_PRIVATE`: Passwordless private SSH key for the WP Engine SSH Gateway
- `WPE_ENV`: WP Engine development environment name

### Deployment options

The workflow uses the official `wpengine/github-action-wpe-site-deploy@v3` action with these options enabled:

- `PHP_LINT: TRUE`
- `CACHE_CLEAR: TRUE`
- rsync flags including `--delete` and `.deployignore` support

### Ignored files

The root `.deployignore` excludes local and build-only files such as:

- `.git` and `.github`
- `node_modules/`
- `src/`
- package and lock files
- common frontend build config files
- `.DS_Store`
- source maps (`*.map`)

### Running a deploy

1. Commit your changes.
2. Push them to the `dev` branch.
3. Open the Actions tab in GitHub to monitor the deployment run.
