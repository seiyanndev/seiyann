import type { Metadata } from "next";
import { siteName } from "@/content/site";
import { ogPages, type OgPage } from "@/content/og";

// The live address: link previews (Open Graph), canonical URLs and the sitemap need absolute addresses.
// If a custom domain is added later, change it here.
export const siteUrl = "https://seiyannn.vercel.app";

// Search terms for the keywords tag. Google ignores this tag for ranking (titles, descriptions and page
// text are what count); it's here for the few tools that still read it.
export const siteKeywords = [
  "Kurt Atoat",
  "graphic designer Lucena City",
  "web developer Lucena City",
  "web developer Philippines",
  "full-stack developer Philippines",
  "freelance web developer",
  "brand identity designer",
  "UI/UX designer",
  "Laravel developer",
  "React developer",
  "WordPress developer",
  "portfolio",
];

/**
 * A page's title, description and link-preview tags. `title` is the full title shown in the browser tab and
 * in Google results. `og` picks the preview image from content/og.ts (served by app/og/).
 */
export function pageMetadata({ title, description, path, og }: { title: string; description: string; path: string; og: OgPage }): Metadata {
  const image = { url: `/og/${og}.png`, width: 1200, height: 630, alt: ogPages[og].alt, type: "image/png" };
  return {
    title: { absolute: title },
    description,
    alternates: { canonical: path },
    openGraph: {
      type: "website",
      siteName,
      locale: "en_US",
      url: path,
      title,
      description,
      images: [image],
    },
    twitter: {
      card: "summary_large_image",
      title,
      description,
      images: [image],
    },
  };
}
