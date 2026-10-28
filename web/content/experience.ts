// Experience page "service record" (app/experience/page.tsx), newest first.
// PLACEHOLDER CONTENT: carried over from the previous page design; Kurt will replace it with his real history.
// Fields: `end` = "" means current (stamped CURRENT). `type`/`location` optional (hidden when empty).
// `tools` = names from content/tools.ts (shown with their logos). `projects` = titles from content/projects.ts (linked).

export type ExperienceRecord = {
  role: string;
  org: string;
  start: string;
  end: string;
  type: string;
  location: string;
  duties: string[];
  tools: string[];
  projects: string[];
};

export const experience: ExperienceRecord[] = [
  {
    role: "Social Media Manager / Graphic Designer", org: "XYZ Digital Agency",
    start: "2025", end: "", type: "", location: "",
    duties: ["Managed social media content and campaigns across multiple platforms.", "Created graphics and digital materials for brand promotion.", "Planned and organized content calendar and influencer collaborations."],
    tools: [], projects: [],
  },
  {
    role: "Web Developer / IT Specialist", org: "ABC Solutions",
    start: "2024", end: "2025", type: "", location: "",
    duties: ["Developed and maintained web applications and internal systems.", "Worked with UI/UX and frontend technologies (HTML, CSS, JavaScript).", "Collaborated with cross-functional teams on technical projects."],
    tools: ["HTML", "CSS", "JavaScript"], projects: [],
  },
  {
    role: "Project / Organization Experience", org: "University / Student Organization",
    start: "2022", end: "2024", type: "", location: "",
    duties: ["Led and participated in various projects and initiatives.", "Organized events, workshops, and community activities.", "Collaborated with teams and stakeholders to achieve goals."],
    tools: [], projects: [],
  },
  {
    role: "UI/UX Designer Intern", org: "Design Studio Hub",
    start: "2021", end: "2022", type: "Internship", location: "",
    duties: ["Assisted in conducting user research and persona mapping.", "Created wireframes, user flows, and interactive prototypes in Figma.", "Participated in client design reviews and design system maintenance."],
    tools: ["Figma"], projects: [],
  },
  {
    role: "Freelance Web Developer", org: "Self-Employed",
    start: "2020", end: "2021", type: "Freelance", location: "",
    duties: ["Built custom WordPress websites and landing pages for small businesses.", "Optimized site performance, responsiveness, and basic on-page SEO.", "Managed direct client communications and project requirements."],
    tools: ["WordPress"], projects: [],
  },
  {
    role: "Open Source Contributor", org: "Community Projects",
    start: "2019", end: "2020", type: "", location: "",
    duties: ["Contributed bug fixes and documentation to frontend repositories.", "Collaborated globally via GitHub issues and pull requests.", "Engaged with developer communities to improve software accessibility."],
    tools: ["GitHub"], projects: [],
  },
];
