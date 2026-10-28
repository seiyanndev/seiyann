import { toolIconPaths } from "@/content/toolIcons";

// Inline SVG for a tool (fills with currentColor so the chip controls its colour).
// Same output as seiyann_tool_icon() in the WordPress theme.
export default function ToolIcon({ slug }: { slug: string }) {
  const path = toolIconPaths[slug];
  if (path && !slug.startsWith("glyph:")) {
    return (
      <svg className="tool-icon" aria-hidden="true" fill="currentColor" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d={path} />
      </svg>
    );
  }

  // Neutral glyphs for tools Simple Icons doesn't carry ("" = code brackets).
  return (
    <svg className="tool-icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" strokeWidth="2.4" strokeLinecap="round" strokeLinejoin="round">
      {slug === "glyph:chat" ? (
        <>
          <path d="M4 5h16v11H9l-5 4z" />
          <path d="M8.5 10.5h.01M12 10.5h.01M15.5 10.5h.01" />
        </>
      ) : slug === "glyph:orbit" ? (
        <>
          <circle cx="12" cy="12" r="3" />
          <ellipse cx="12" cy="12" rx="10" ry="4.5" transform="rotate(-30 12 12)" />
          <path d="M19.5 4.5h.01" />
        </>
      ) : (
        <path d="M8 7l-5 5 5 5M16 7l5 5-5 5M13.5 4l-3 16" />
      )}
    </svg>
  );
}
