import { ImageResponse } from "next/og";
import { readFile } from "node:fs/promises";
import { join } from "node:path";

// The "KA" mark from the nav logo (grey K, ink A), white on ink so it reads in light and dark tabs.
export async function renderIcon(px: number, rounded: boolean) {
  const font = await readFile(join(process.cwd(), "og-fonts", "Montserrat-ExtraBold.ttf"));
  return new ImageResponse(
    (
      <div
        style={{
          width: "100%",
          height: "100%",
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
          backgroundColor: "#0a0a0a",
          borderRadius: rounded ? px * 0.22 : 0,
          fontFamily: "Montserrat",
          fontWeight: 800,
          fontSize: px * 0.5,
          letterSpacing: -px * 0.03,
        }}
      >
        <span style={{ color: "#a1a1aa" }}>K</span>
        <span style={{ color: "#fafafa" }}>A</span>
      </div>
    ),
    { width: px, height: px, fonts: [{ name: "Montserrat", data: font, weight: 800, style: "normal" }] }
  );
}
