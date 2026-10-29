import { renderOgImage } from "@/lib/og";
import { ogPages, type OgPage } from "@/content/og";

// Link-preview images at /og/<page>.png, rendered at build time. A route ending in ".png" rather than
// the opengraph-image file convention: with trailingSlash on, extensionless image URLs would answer
// with a redirect, which some link-preview crawlers don't follow.
export const dynamic = "force-static";
export const dynamicParams = false;

export function generateStaticParams() {
  return Object.keys(ogPages).map((key) => ({ name: `${key}.png` }));
}

export async function GET(_req: Request, ctx: RouteContext<"/og/[name]">) {
  const { name } = await ctx.params;
  const page = ogPages[name.replace(/\.png$/, "") as OgPage];
  if (!page) return new Response("Not found", { status: 404 });
  return renderOgImage(page);
}
