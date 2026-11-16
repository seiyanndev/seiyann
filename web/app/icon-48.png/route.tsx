import { renderIcon } from "@/lib/icon";

// 48x48 icon at /icon-48.png, the smallest size Google Search accepts for a favicon.
export const dynamic = "force-static";

export function GET() {
  return renderIcon(48, true);
}
