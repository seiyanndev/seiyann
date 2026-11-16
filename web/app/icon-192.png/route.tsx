import { renderIcon } from "@/lib/icon";

// Larger icon at /icon-192.png: Google Search shows a favicon only if one is at least 48x48.
export const dynamic = "force-static";

export function GET() {
  return renderIcon(192, true);
}
