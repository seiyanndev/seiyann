import type { MetadataRoute } from "next";
import { siteUrl } from "@/lib/metadata";

// /sitemap.xml: the six pages, for Google Search Console.
const PAGES = [
  { path: "/", priority: 1 },
  { path: "/work/", priority: 0.9 },
  { path: "/capabilities/", priority: 0.8 },
  { path: "/about/", priority: 0.8 },
  { path: "/experience/", priority: 0.7 },
  { path: "/contact/", priority: 0.7 },
];

export default function sitemap(): MetadataRoute.Sitemap {
  return PAGES.map(({ path, priority }) => ({
    url: `${siteUrl}${path}`,
    changeFrequency: "monthly",
    priority,
  }));
}
