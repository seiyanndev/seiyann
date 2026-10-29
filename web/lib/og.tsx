import { ImageResponse } from "next/og";
import { readFile } from "node:fs/promises";
import { join } from "node:path";

// Link-preview images (Open Graph): a Dossier cover sheet for each page, rendered at build time.
// Fonts are local TTFs (og-fonts/, SIL Open Font License) because the renderer can't use Google Fonts CSS.

export const ogSize = { width: 1200, height: 630 };

const INK = "#0a0a0a";
const MUTED = "#80868f";
const GREEN = "#15803d";

let fonts: Promise<{ name: string; data: Buffer; weight: 500 | 700 | 800; style: "normal" }[]> | null = null;
function loadFonts() {
  const file = (name: string) => readFile(join(process.cwd(), "og-fonts", name));
  fonts ??= Promise.all([
    file("Montserrat-Medium.ttf").then((data) => ({ name: "Montserrat", data, weight: 500 as const, style: "normal" as const })),
    file("Montserrat-ExtraBold.ttf").then((data) => ({ name: "Montserrat", data, weight: 800 as const, style: "normal" as const })),
    file("SpaceMono-Bold.ttf").then((data) => ({ name: "Space Mono", data, weight: 700 as const, style: "normal" as const })),
  ]);
  return fonts;
}

// Barcode stripe widths (px): bar, gap, bar, gap... (the contents-bars pattern in styles/home.css).
const BARS = [2, 2, 1, 3, 3, 1, 1, 3];

// Printer's crop mark in one corner. (The renderer rejects style keys set to undefined, so only the
// sides in use are added.)
function Crop({ v, h }: { v: "top" | "bottom"; h: "left" | "right" }) {
  const side = (s: string) => `border${s[0].toUpperCase()}${s.slice(1)}`;
  return (
    <div
      style={{
        position: "absolute",
        width: 28,
        height: 28,
        [v]: 28,
        [h]: 28,
        [side(v)]: `2px solid ${INK}`,
        [side(h)]: `2px solid ${INK}`,
      }}
    />
  );
}

/**
 * section/fileNo: the eyebrow ("Work / File No. 001"). lines: the headline, first line in ink and the rest
 * muted, like the page titles.
 */
export async function renderOgImage({ section, fileNo, lines }: { section: string; fileNo: string; lines: string[] }) {
  // Montserrat ExtraBold averages ~0.62em per character: size the headline so its longest line fits.
  const longest = Math.max(...lines.map((line) => line.length));
  const fontSize = Math.min(96, Math.floor(1020 / (longest * 0.62)));

  return new ImageResponse(
    (
      <div style={{ width: "100%", height: "100%", display: "flex", flexDirection: "column", justifyContent: "space-between", padding: "76px 92px 70px", backgroundColor: "#faf9f5", fontFamily: "Montserrat", position: "relative" }}>
        <Crop v="top" h="left" />
        <Crop v="top" h="right" />
        <Crop v="bottom" h="left" />
        <Crop v="bottom" h="right" />

        {/* Eyebrow + stamp */}
        <div style={{ display: "flex", alignItems: "center", justifyContent: "space-between" }}>
          <div style={{ display: "flex", alignItems: "center", fontFamily: "Space Mono", fontSize: 19, letterSpacing: 4.5, textTransform: "uppercase", color: "#6b7280" }}>
            <div style={{ width: 56, height: 2, backgroundColor: "#a1a1aa", marginRight: 20 }} />
            <span>{section}</span>
            <span style={{ color: "#c4c8ce", margin: "0 16px" }}>/</span>
            <span>{`File No. ${fileNo}`}</span>
          </div>
          <div style={{ display: "flex", padding: 4, border: `3px solid ${GREEN}`, borderRadius: 9, transform: "rotate(-8deg)", opacity: 0.9, marginRight: 8 }}>
            <div style={{ display: "flex", padding: "12px 22px", border: `1.5px solid ${GREEN}`, borderRadius: 5, fontSize: 22, fontWeight: 800, letterSpacing: 4.4, color: GREEN, textTransform: "uppercase" }}>
              Open to work
            </div>
          </div>
        </div>

        {/* Headline */}
        <div style={{ display: "flex", flexDirection: "column", fontSize, fontWeight: 800, lineHeight: 1.04, letterSpacing: -fontSize * 0.035 }}>
          {lines.map((line, i) => (
            <div key={line} style={{ display: "flex", color: i === 0 ? INK : MUTED }}>{line}</div>
          ))}
        </div>

        {/* Signature + barcode */}
        <div style={{ display: "flex", alignItems: "flex-end", justifyContent: "space-between", borderTop: `2px solid ${INK}`, paddingTop: 22 }}>
          <div style={{ display: "flex", flexDirection: "column" }}>
            <div style={{ display: "flex", fontSize: 30, fontWeight: 800, color: INK, letterSpacing: -0.5 }}>Kurt Atoat</div>
            <div style={{ display: "flex", fontSize: 20, fontWeight: 500, color: "#4b5563", marginTop: 4 }}>Graphic Designer &amp; Full-Stack Developer</div>
          </div>
          <div style={{ display: "flex", flexDirection: "column", alignItems: "flex-end" }}>
            <div style={{ display: "flex", height: 30 }}>
              {Array.from({ length: 3 }).flatMap((_, r) =>
                BARS.map((w, i) => <div key={`${r}-${i}`} style={{ width: w * 2, height: 30, backgroundColor: i % 2 === 0 ? INK : "transparent" }} />)
              )}
            </div>
            <div style={{ display: "flex", fontFamily: "Space Mono", fontSize: 15, letterSpacing: 3, color: "#6b7280", marginTop: 8 }}>{`KA · ${fileNo} · SEIYANNN.VERCEL.APP`}</div>
          </div>
        </div>
      </div>
    ),
    { ...ogSize, fonts: await loadFonts() }
  );
}
