// About page "toolbox" tapes (and the tool chips on Experience records). `icon` is a Simple Icons slug
// from content/toolIcons.ts, or a neutral glyph for tools Simple Icons doesn't carry: "" = code brackets
// (VS Code, logo removed at Microsoft's request), "glyph:chat" (ChatGPT, OpenAI logos removed),
// "glyph:orbit" (Antigravity, not listed). `hex` is the brand colour a chip fills with on hover.
// `tape`: "ink" (languages/frameworks) or "paper" (tools/apps).

export type Tool = { name: string; icon: string; hex: string; tape: "ink" | "paper" };

export const tools: Tool[] = [
  { name: "HTML", icon: "html5", hex: "#E34F26", tape: "ink" },
  { name: "CSS", icon: "css", hex: "#663399", tape: "ink" },
  { name: "JavaScript", icon: "javascript", hex: "#F7DF1E", tape: "ink" },
  { name: "Tailwind CSS", icon: "tailwindcss", hex: "#06B6D4", tape: "ink" },
  { name: "React", icon: "react", hex: "#61DAFB", tape: "ink" },
  { name: "PHP", icon: "php", hex: "#777BB4", tape: "ink" },
  { name: "Laravel", icon: "laravel", hex: "#FF2D20", tape: "ink" },
  { name: "Python", icon: "python", hex: "#3776AB", tape: "ink" },
  { name: "WordPress", icon: "wordpress", hex: "#21759B", tape: "ink" },
  { name: "SQL", icon: "mysql", hex: "#4479A1", tape: "ink" },
  { name: "Supabase", icon: "supabase", hex: "#3FCF8E", tape: "ink" },
  { name: "VS Code", icon: "", hex: "#007ACC", tape: "paper" },
  { name: "Cursor", icon: "cursor", hex: "#000000", tape: "paper" },
  { name: "Git", icon: "git", hex: "#F03C2E", tape: "paper" },
  { name: "GitHub", icon: "github", hex: "#181717", tape: "paper" },
  { name: "Figma", icon: "figma", hex: "#F24E1E", tape: "paper" },
  { name: "GSAP", icon: "gsap", hex: "#0AE448", tape: "paper" },
  { name: "Claude", icon: "claude", hex: "#D97757", tape: "paper" },
  { name: "ChatGPT", icon: "glyph:chat", hex: "#10A37F", tape: "paper" },
  { name: "Gemini", icon: "googlegemini", hex: "#8E75B2", tape: "paper" },
  { name: "Antigravity", icon: "glyph:orbit", hex: "#4285F4", tape: "paper" },
];

/** Readable text colour (#0a0a0a or #ffffff) on top of a hex background. */
export function onColor(hex: string): string {
  const h = hex.replace(/^#/, "");
  const [r, g, b] = [0, 2, 4].map((i) => parseInt(h.slice(i, i + 2), 16));
  const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
  return luminance > 0.6 ? "#0a0a0a" : "#ffffff";
}
