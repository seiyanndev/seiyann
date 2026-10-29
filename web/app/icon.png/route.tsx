import { renderIcon } from "@/lib/icon";

// Browser tab icon at /icon.png (linked from app/layout.tsx), rendered at build time.
export const dynamic = "force-static";

export function GET() {
  return renderIcon(32, true);
}
