# Tests

Here is the documentation of tools provided to test you code.

## PHPStan - static code analysis

PHPStan is a strong static code analyser tool.

It helps you fix most obvious code errors.

```bash
docker compose exec app composer phpstan:check
```

## Pint - Code style check & fix

Laravel Pint is an opinionated PHP code style fixer for minimalists. Pint is built on top of PHP CS Fixer and makes it simple to ensure that your code style stays clean and consistent.

### Check code style

```bash
docker compose exec app composer cs:check
```

or use this one to have more insight about what will be fixed

```bash
docker compose exec app composer cs:check:verbose
```

### Fixing code style

This tool will fix the code for you.

```bash
docker compose exec app composer cs:fix
```
