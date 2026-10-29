import type { Metadata } from "next";
import { siteName } from "@/content/site";
import { ogPages, type OgPage } from "@/content/og";

// The live domain: link previews (Open Graph) and canonical URLs need absolute addresses.
export const siteUrl = "https://seiyann.dev";

const homeTitle = `${siteName} – Graphic Designer & Full-Stack Developer`;

/**
 * A page's title, description and link-preview tags. `title` is the page's own name ("Work: Case Files");
 * leave it out for the homepage. `og` picks the preview image from content/og.ts (served by app/og/).
 */
export function pageMetadata({ title, description, path, og }: { title?: string; description: string; path: string; og: OgPage }): Metadata {
  const fullTitle = title ? `${title} – ${siteName}` : homeTitle;
  const image = { url: `/og/${og}.png`, width: 1200, height: 630, alt: ogPages[og].alt, type: "image/png" };
  return {
    title: title ?? { absolute: homeTitle },
    description,
    alternates: { canonical: path },
    openGraph: {
      type: "website",
      siteName,
      locale: "en_US",
      url: path,
      title: fullTitle,
      description,
      images: [image],
    },
    twitter: {
      card: "summary_large_image",
      title: fullTitle,
      description,
      images: [image],
    },
  };
}
