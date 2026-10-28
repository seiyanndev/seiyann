import type { Metadata, Viewport } from "next";
import Header from "@/components/Header";
import Footer from "@/components/Footer";
import Cursor from "@/components/Cursor";
import { siteName } from "@/content/site";

// The theme's stylesheets, unchanged and in the order WordPress printed them. Every page's CSS is
// loaded site-wide: their selectors are namespaced per page, and client-side navigation keeps
// stylesheets around anyway, so this gives every page the same cascade whichever page loads first.
import "@/styles/dark-mode.css";
import "@/styles/cursor.css";
import "@/styles/home.css";
import "@/styles/work.css";
import "@/styles/capabilities.css";
import "@/styles/about.css";
import "@/styles/experience.css";
import "@/styles/contact.css";
// Tailwind last, where the Play CDN put it (appended to the end of <head>).
import "./globals.css";

export const metadata: Metadata = {
  title: {
    default: `${siteName} – Graphic Designer & Full-Stack Developer`,
    template: `%s – ${siteName}`,
  },
  description:
    "Kurt Atoat is a graphic designer and full-stack developer in Lucena City, Philippines, creating brand identities, UI/UX and web applications.",
};

export const viewport: Viewport = {
  width: "device-width",
  initialScale: 1,
};

// Before first paint: the `js` class lets CSS hide JS-animated elements until their script has set
// them up, and the saved theme is applied so dark mode doesn't flash light (defaults to light).
const headScript = `(function(){document.documentElement.classList.add("js");var theme="light";try{theme=localStorage.getItem("nav_theme")||"light";}catch(e){}if(theme==="dark")document.documentElement.classList.add("dark");})();`;

export default function RootLayout({ children }: LayoutProps<"/">) {
  return (
    // data-scroll-behavior lets Next.js turn smooth scrolling off while it changes pages, so a new page
    // starts at the top instantly (like a page load did) and in-page anchors still scroll smoothly.
    <html lang="en-US" className="scroll-smooth" data-scroll-behavior="smooth" suppressHydrationWarning>
      <head>
        {/* eslint-disable-next-line @next/next/no-page-custom-font -- same Google Fonts stylesheet as the WordPress theme; the CSS refers to the "Montserrat" family by name */}
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800&display=swap" rel="stylesheet" />
        <script dangerouslySetInnerHTML={{ __html: headScript }} />
      </head>

      {/* Light-mode classes; styles/dark-mode.css remaps them when <html> has the `dark` class */}
      <body className="bg-[#faf9f5] text-gray-900 antialiased selection:bg-black selection:text-white min-h-screen flex flex-col relative overflow-x-clip">
        {/* Bottom padding on phones keeps content clear of the bottom nav bar */}
        <div id="page" className="site min-h-screen flex flex-col relative overflow-x-clip pb-24 md:pb-0">
          <Header />
          {children}
          <Footer />
        </div>
        <Cursor />
      </body>
    </html>
  );
}
