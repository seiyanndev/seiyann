// Link-preview images, one per page: the eyebrow, the headline (first line in ink, the rest muted),
// and the alt text. Rendered by app/og/[name]/route.tsx as /og/<key>.png.
export const ogPages = {
  home: { section: "Cover sheet", fileNo: "000", lines: ["I design visual identities,", "build digital products,", "and turn ideas into real solutions."], alt: "Kurt Atoat, graphic designer and full-stack developer: cover sheet of the portfolio" },
  work: { section: "Work", fileNo: "001", lines: ["Case files.", "Selected work."], alt: "Kurt Atoat's case files: selected work" },
  capabilities: { section: "Capabilities", fileNo: "002", lines: ["Design. Code.", "Build."], alt: "Kurt Atoat's capabilities: design, code, build" },
  about: { section: "About", fileNo: "003", lines: ["Designing experiences.", "Building products."], alt: "About Kurt Atoat: personnel file" },
  experience: { section: "Experience", fileNo: "004", lines: ["Service record.", "Where the work happened."], alt: "Kurt Atoat's service record" },
  contact: { section: "Contact", fileNo: "005", lines: ["Open a file.", "Let's work together."], alt: "Contact Kurt Atoat: request form" },
};

export type OgPage = keyof typeof ogPages;
