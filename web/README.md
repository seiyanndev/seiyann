# seiyann.dev (Next.js)

Kurt Atoat's portfolio, ported from the WordPress theme in the repository root. It renders the same pages,
at the same URLs, with the same CSS and animations.

| URL | Page | WordPress template |
| --- | --- | --- |
| `/` | Cover sheet | `front-page.php` |
| `/work/` | Case files | `page-work.php` |
| `/capabilities/` | Exhibit A | `page-capabilities.php` |
| `/about/` | Personnel file | `page-about.php` |
| `/experience/` | Service record | `page-experience.php` |
| `/contact/` | Request form | `page-contact.php` |

## Run locally

Requires Node.js 20.9 or newer.

```bash
npm install
cp .env.example .env.local   # paste your Web3Forms access key into .env.local
npm run dev                  # http://localhost:3000
```

Other commands: `npm run build` (production build), `npm start` (serve that build), `npm run lint`.

Without a key in `.env.local`, everything works except sending the contact form: it shows the
RETURNED stamp and logs a message in the browser console.

## Deploy to Vercel

1. On vercel.com, choose **Add New → Project** and import this GitHub repository.
2. Set **Root Directory** to `web`. Vercel detects Next.js; leave the build settings as they are.
3. Under **Environment Variables**, add `NEXT_PUBLIC_WEB3FORMS_KEY` with your Web3Forms access key, for
   Production and Preview.
4. Deploy. Vercel redeploys on every push to `main`.

The key is baked into the JavaScript at build time. **After adding or changing it, redeploy**
(Deployments → ⋯ → Redeploy) for the change to take effect.

### The environment variable

| Name | Value | Where |
| --- | --- | --- |
| `NEXT_PUBLIC_WEB3FORMS_KEY` | Access key from [web3forms.com](https://web3forms.com), emailed to the address that receives messages | `.env.local` locally, Vercel project settings in production |

The key is public by design, because it ends up in the browser, and it can only send mail to your inbox. In
the Web3Forms dashboard, restrict it to your domain so other sites can't use it. `.env.local` is git-ignored,
so don't commit it. Only `.env.example` (no value) is committed.

## Where things live

- `content/`: all site copy and data, moved from `functions.php`: projects, capabilities, experience,
  tools and contact details. Edit these files to update the site.
- `app/`: one folder per page; `app/layout.tsx` holds the shared shell (header.php / footer.php).
- `components/`: the nav (`Header.tsx`), the site cursor, and one client component per page that runs
  that page's animations (ported from `assets/js/`).
- `styles/`: the theme's CSS files, unchanged. Tailwind (v3, same config as the old Play CDN) is compiled at
  build time from `app/globals.css`.
- `public/assets/`: images, at the same paths as the theme's `assets/` folder.

## Launch checklist

- [ ] Get a Web3Forms access key and add `NEXT_PUBLIC_WEB3FORMS_KEY` in Vercel, then redeploy.
- [ ] Send a real message from the live contact form and confirm it reaches your inbox (check spam too).
- [ ] Restrict the Web3Forms key to `seiyann.dev` in the Web3Forms dashboard.
- [ ] Add the `seiyann.dev` domain in Vercel (Project → Settings → Domains) and update DNS as Vercel shows.
- [ ] Replace the placeholder roles in `content/experience.ts` with your real history.
- [ ] Review the page titles and meta descriptions (the `metadata` export at the top of each `app/*/page.tsx`).
- [ ] Optional: add a favicon. The WordPress site had none; drop an `icon.png` into `app/` and Next.js serves it.
- [ ] Click through every page on a real phone: the bottom nav, tapping a headline word, opening folders,
      and the form.
- [ ] Check the dark-mode toggle in Safari and Firefox (the circle reveal needs the View Transitions API;
      other browsers fall back to a cross-fade).
