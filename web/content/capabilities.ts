import type { Project } from "./projects";

// Capabilities page: the four stages of the "lens" section and the columns of the proof matrix.
// Which projects back each one is derived from the project categories (projectCaps()).

export type CapabilityKey = "brand" | "ui" | "web" | "e2e";

export type Capability = {
  key: CapabilityKey;
  title: string;
  summary: string;
  deliverables: string[];
};

export const capabilities: Capability[] = [
  {
    key: "brand",
    title: "Brand Identity",
    summary: "Visual systems that make a business recognisable at a glance.",
    deliverables: ["Logo design", "Brand guidelines", "Print & digital collateral", "Visual systems"],
  },
  {
    key: "ui",
    title: "UI/UX Design",
    summary: "Interfaces that are clear, intuitive and built around the people using them.",
    deliverables: ["Wireframes & prototypes", "User research", "Interactive design", "Responsive design"],
  },
  {
    key: "web",
    title: "Web Development",
    summary: "Responsive web applications, from the database to deployment.",
    deliverables: ["Frontend development", "Backend development", "Database management", "Deployment"],
  },
  {
    key: "e2e",
    title: "End-to-End",
    summary: "One person from first sketch to shipped product, so nothing gets lost between design and code.",
    deliverables: ["Concept development", "Art direction", "Visual storytelling", "End-to-end production"],
  },
];

/** Capability keys a project demonstrates, from its category text. End-to-end = all three disciplines. */
export function projectCaps(project: Project): CapabilityKey[] {
  const category = project.category.toLowerCase();
  const caps: CapabilityKey[] = [];
  if (category.includes("branding")) caps.push("brand");
  if (category.includes("ui-ux")) caps.push("ui");
  if (category.includes("web development")) caps.push("web");
  if (caps.length === 3) caps.push("e2e");
  return caps;
}
