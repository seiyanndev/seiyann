import type { NextConfig } from "next";

const nextConfig: NextConfig = {
  // The WordPress site's URLs end in a slash (/work/, /about/...): keep them identical.
  trailingSlash: true,
  // cacheComponents is left off on purpose: it keeps visited pages mounted (hidden) after you
  // navigate away, which would leave their GSAP timelines, ScrollTrigger pins and tickers running.
  // Each page should start fresh, like a page load on the WordPress site.
};

export default nextConfig;
