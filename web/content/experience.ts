// Experience page "service record" (app/experience/page.tsx), newest first.
// Fields: `end` = "" means current (stamped CURRENT). `type`/`location` optional (hidden when empty).
// `duties` optional (the Duties row is hidden when empty).
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
    role: "Full Stack Developer", org: "Pixel Hive",
    start: "2026", end: "", type: "", location: "",
    duties: ["Build and maintain client websites and web applications, from frontend interfaces to backend logic and databases.", "Turn UI/UX designs into responsive, accessible, production-ready pages.", "Work with the team on deployments, performance tuning, and ongoing site maintenance."],
    tools: ["HTML", "CSS", "JavaScript", "Tailwind CSS", "React", "PHP", "Laravel", "Python", "WordPress", "SQL", "Supabase", "Git", "GitHub"], projects: [],
  },
  {
    role: "Web Developer", org: "Self-Employed",
    start: "2025", end: "2026", type: "", location: "",
    duties: ["Designed and developed custom web applications for clients, from planning to deployment.", "Built full-stack features including databases, user accounts, and admin dashboards.", "Handled hosting, deployment, and post-launch support for each project."],
    tools: ["React", "Laravel", "Supabase"], projects: [],
  },
  {
    role: "Vice President", org: "DLL ELITE (Elevating Leaders Innovatively Through Trainings and Excellence)",
    start: "2024", end: "2026", type: "Student Organization", location: "",
    duties: ["Supported the president in leading the organization's officers and members across two terms.", "Planned and ran leadership trainings, workshops, and student events.", "Coordinated programs with faculty, partner organizations, and other student groups."],
    tools: [], projects: [],
  },
  {
    role: "President", org: "IT Paradigm",
    start: "2023", end: "2026", type: "Student Organization", location: "",
    duties: ["Led the BSIT student organization for three consecutive terms, guiding its officers and members.", "Organized tech events, workshops, and community activities for IT students.", "Represented the department's students and worked with faculty and partner organizations on programs and initiatives."],
    tools: [], projects: [],
  },
  {
    role: "Freelance Graphic Designer", org: "Self-Employed",
    start: "2023", end: "2024", type: "Freelance", location: "",
    duties: ["Designed logos, brand identities, and visual guidelines for small businesses.", "Created social media graphics, print materials, and marketing collateral.", "Worked directly with clients through concepts, revisions, and final file delivery."],
    tools: ["Figma"], projects: [],
  },
  {
    role: "Freelance Web Developer", org: "Self-Employed",
    start: "2022", end: "2023", type: "Freelance", location: "",
    duties: ["Built custom WordPress websites and landing pages for small businesses.", "Optimized site performance, responsiveness, and basic on-page SEO.", "Managed direct client communications and project requirements."],
    tools: ["WordPress"], projects: [],
  },
  {
    role: "Open Source Contributor", org: "Community Projects",
    start: "2021", end: "2022", type: "", location: "",
    duties: ["Contributed bug fixes and documentation to frontend repositories.", "Collaborated globally via GitHub issues and pull requests.", "Engaged with developer communities to improve software accessibility."],
    tools: ["GitHub"], projects: [],
  },
];
