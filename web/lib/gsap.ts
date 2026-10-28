// GSAP core + the plugins the pages use (the WordPress theme loaded these from the jsDelivr CDN).
// Import from here in client components so the plugins are always registered.
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";
import { SplitText } from "gsap/SplitText";

if (typeof window !== "undefined") {
  gsap.registerPlugin(ScrollTrigger, SplitText);
}

export { gsap, ScrollTrigger, SplitText };

export const prefersReducedMotion = () => window.matchMedia("(prefers-reduced-motion: reduce)").matches;
