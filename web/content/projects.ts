// Work page projects (filing cabinet in app/work/page.tsx). `image` is a file in public/assets/
// (left empty, the case sheet shows generated abstract `art` instead: a variant from styles/work.css
// plus four colours).

export type ArtVariant = "marble" | "streaks" | "folds" | "silk" | "pour";

export type Project = {
  title: string;
  tag: string;
  category: string;
  summary: string;
  description: string;
  image: string;
  /** Image size in px, used by next/image (the CSS decides the displayed size). */
  imageSize?: { width: number; height: number };
  art: [ArtVariant, string, string, string, string];
};

export const projects: Project[] = [
  {
    title: "Agrilink", tag: "Web App", category: "UI-UX / Web Development",
    summary: "Farm-to-table marketplace with GIS monitoring.",
    description: "A demand-driven agricultural e-commerce and GIS-based monitoring system designed for Lucena City. It connects local farmers and consumers directly, allowing buyers to request products and farmers to respond, creating a flexible farm-to-table marketplace.",
    image: "", art: ["marble", "#0f5132", "#7ed957", "#f4e04d", "#1b998b"],
  },
  {
    title: "BRRCS", tag: "Records System", category: "UI-UX / Web Development",
    summary: "Resident records and barangay certificates, automated.",
    description: "Barangay Residential Record and Certification System (BRRCS) is a streamlined digital tool built to automate resident record tracking, clearances, and barangay certificate issuance securely.",
    image: "", art: ["folds", "#0b1f4d", "#2f6bff", "#9cc3ff", "#f2f5ff"],
  },
  {
    title: "LoanTrackr", tag: "PWA", category: "UI-UX / Web Development",
    summary: "Loans, payments and balances, tracked in one place.",
    description: "LoanTrackr is a simple and efficient personal loan tracking Progressive Web App (PWA) that helps you stay in control of your finances. It allows you to record loans, monitor payments, and track remaining balances—all in one place.",
    image: "", art: ["streaks", "#06281f", "#00c2a8", "#c6ff3d", "#ffffff"],
  },
  {
    title: "Seiyann", tag: "Brand + CMS", category: "Branding / UI-UX / Web Development",
    summary: "A portfolio and content system built from scratch.",
    description: "Seiyann is a custom, full-stack dynamic portfolio and content management system built from scratch. It features modular custom page templates, an interactive multi-category project filtering engine, dynamic modals, and a robust owner-only dashboard designed to seamlessly manage projects, credentials, and achievements in real time.",
    image: "portfoliocms.png", imageSize: { width: 1920, height: 1080 },
    art: ["silk", "#111111", "#4f2bff", "#ff4d3d", "#f5f5f5"],
  },
  {
    title: "Sidequest", tag: "Branding", category: "Branding / UI-UX",
    summary: "Self-improvement, played as an adventure.",
    description: "Sidequest is a gamified self-improvement platform designed to turn personal growth into an engaging adventure. By combining daily micro-quests, habit streaks, mood reflection tools, and XP progression systems, it helps users stay accountable, break productivity slumps, and build lasting lifestyle habits.",
    image: "sidequest.png", imageSize: { width: 1714, height: 918 },
    art: ["streaks", "#1a0b3d", "#ff9f1c", "#2ec4b6", "#ffffff"],
  },
  {
    title: "BrewFlow", tag: "POS System", category: "UI-UX / Web Development",
    summary: "Point of sale and stock control for coffee shops.",
    description: "BrewFlow is a smart POS & inventory management system engineered specifically for modern coffee shops. It streamlines daily operations by automating stock tracking for perishable ingredients, providing rapid-fire order processing interfaces, and delivering real-time analytics to help cafe owners optimize margins and reduce waste.",
    image: "", art: ["pour", "#2b1408", "#c87533", "#f3d9b1", "#1a0b05"],
  },
  {
    title: "Parallel HQ", tag: "Brand + Store", category: "Branding / UI-UX / Web Development",
    summary: "Identity and storefront for curated thrift.",
    description: "Parallel HQ is a digital storefront and curated brand identity platform built for modern thrifted and vintage apparel. The project blends sustainable fashion aesthetics with an intuitive e-commerce experience, featuring seamless product discovery, editorial-style lookbooks, and a streamlined checkout flow designed to elevate secondhand shopping for the next generation.",
    image: "", art: ["silk", "#ff2e63", "#ffb3c6", "#4f2bff", "#fff1f5"],
  },
  {
    title: "Vestia", tag: "Web App", category: "UI-UX / Web Development",
    summary: "Finding exceptional places to live, simplified.",
    description: "Vestia exists to simplify the search for exceptional living spaces through a modern, trustworthy, and beautifully designed digital experience. It provides intuitive property discovery flows, detailed accommodation insights, and a seamless interface tailored for modern renters.",
    image: "", art: ["folds", "#e07a5f", "#f2cc8f", "#3d405b", "#f4f1de"],
  },
  {
    title: "Veya", tag: "Travel", category: "UI-UX / Web Development",
    summary: "Itineraries, routes and bookings in one plan.",
    description: "Veya is an all-in-one travel management and itinerary planning platform designed to streamline trip coordination. It features interactive route mapping, collaborative travel schedules, real-time booking updates, and an immersive user interface built to simplify destination discovery for modern travelers.",
    image: "", art: ["streaks", "#2a0a5e", "#8b5cf6", "#3ef07a", "#ffffff"],
  },
  {
    title: "Auslands Care", tag: "UI/UX Revamp", category: "UI-UX Design",
    summary: "An NDIS housing site redesigned for accessibility.",
    description: "Auslands Care is a comprehensive UI/UX design revamp for an NDIS accommodation website. The redesign focuses on accessibility, user trust, and a seamless discovery process to help participants and families easily find specialized disability housing and support services.",
    image: "", art: ["silk", "#0e7c86", "#9ee6d8", "#ff8a5b", "#fdf6ec"],
  },
  {
    title: "BEST DSS", tag: "Decision Support", category: "UI-UX / Web Development",
    summary: "Complex data turned into clear decisions.",
    description: "BEST DSS is an advanced decision support system where I spearheaded both the UI/UX design and frontend development. The project focuses on translating complex data structures into clean, intuitive interfaces and responsive, high-performance web components for optimized decision-making.",
    image: "", art: ["pour", "#f9d71c", "#1d3557", "#3a86ff", "#0b132b"],
  },
  {
    title: "Alan Associates", tag: "UI/UX + Frontend", category: "UI-UX / Web Development",
    summary: "A debt-recovery site rebuilt around trust.",
    description: "Alan Associates is a trusted Australian business debt collection and credit management specialist website. I handled the complete UI/UX design revamp and frontend development, creating a clean, professional, and empathetic digital experience designed to build trust and streamline client outreach.",
    image: "", art: ["marble", "#0b132b", "#1c2541", "#c9a227", "#e0e1dd"],
  },
  {
    title: "Reliable Touch Cleaning Services", tag: "UI/UX + Frontend", category: "UI-UX / Web Development",
    summary: "A cleaning-services site built to convert bookings.",
    description: "Reliable Touch Cleaning Services is a modern website redesign and frontend development project. I spearheaded the UI/UX revamp and custom frontend implementation to deliver a clean, trustworthy, and conversion-focused platform optimized for service bookings.",
    image: "", art: ["marble", "#00b4d8", "#caf0f8", "#0077b6", "#ffffff"],
  },
];

/** Two-digit case number, e.g. 5 → "05". */
export const pad2 = (n: number) => String(n).padStart(2, "0");

/** Anchor on the Work page that opens a project's folder (/work/#project-05). */
export const projectHref = (index: number) => `/work/#project-${pad2(index + 1)}`;
