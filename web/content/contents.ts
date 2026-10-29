import { projects, pad2 } from "./projects";
import { capabilities } from "./capabilities";
import { experience } from "./experience";

// The Dossier's index, one row per file: the homepage Contents section and the 404 page.
export const contents = [
  { num: "001", href: "/work/", page: "Work", title: "Case files", detail: `${pad2(projects.length)} cases` },
  { num: "002", href: "/capabilities/", page: "Capabilities", title: "Exhibit A", detail: `${capabilities.length} disciplines` },
  { num: "003", href: "/about/", page: "About", title: "Personnel file", detail: "Kurt Atoat" },
  { num: "004", href: "/experience/", page: "Experience", title: "Service record", detail: `${pad2(experience.length)} roles` },
  { num: "005", href: "/contact/", page: "Contact", title: "Request form", detail: "Open to work" },
];
