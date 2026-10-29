import type { MetadataRoute } from "next";
import { siteUrl } from "@/lib/metadata";

// /robots.txt: everything may be crawled; points search engines at the sitemap.
export default function robots(): MetadataRoute.Robots {
  return {
    rules: { userAgent: "*", allow: "/" },
    sitemap: `${siteUrl}/sitemap.xml`,
  };
}
