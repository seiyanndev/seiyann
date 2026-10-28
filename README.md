# seiyann

Kurt Atoat's portfolio ("The Dossier").

- **`web/`**: the live site, a Next.js app deployed on Vercel. Start with [web/README.md](web/README.md).
- **Repository root**: the original WordPress theme (`*.php`, `functions.php`, `assets/`). It is kept for
  reference; the Next.js app is a page-for-page port of it.

## Next.js site (web/)

Run locally:

```bash
cd web
npm install
cp .env.example .env.local   # then paste your Web3Forms access key into .env.local
npm run dev                  # http://localhost:3000
```

Deploy on Vercel: import this repository, set **Root Directory** to `web`, and add the environment variable
`NEXT_PUBLIC_WEB3FORMS_KEY`. Full steps and a launch checklist are in [web/README.md](web/README.md).
