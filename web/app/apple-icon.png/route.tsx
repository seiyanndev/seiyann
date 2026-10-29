import { renderIcon } from "@/lib/icon";

// Home-screen icon on iPhone/iPad at /apple-icon.png (iOS rounds the corners itself).
export const dynamic = "force-static";

export function GET() {
  return renderIcon(180, false);
}
