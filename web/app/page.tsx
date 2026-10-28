import type { Metadata } from "next";
import Link from "next/link";
import { heroLines, heroSlides, siteName } from "@/content/site";
import { projects, pad2 } from "@/content/projects";
import { capabilities } from "@/content/capabilities";
import { experience } from "@/content/experience";
import HeroHeadline from "@/components/home/HeroHeadline";
import HeroVisual from "@/components/home/HeroVisual";
import HomeCover from "@/components/home/HomeCover";

export const metadata: Metadata = {
  title: { absolute: `${siteName} – Graphic Designer & Full-Stack Developer` },
  description:
    "Cover sheet: Kurt Atoat designs visual identities, builds digital products and turns ideas into real solutions. Open to work, based in Lucena City, PH.",
};

// Glitch typefaces, subset to only the headline's characters so each file is a few KB.
const heroGlyphs = Array.from(new Set(heroLines.map((line) => line.text).join("")))
  .filter((char) => char !== " ")
  .sort()
  .join("");
const glitchFontsHref =
  "https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Space+Mono:wght@700&family=UnifrakturMaguntia&family=Bebas+Neue&family=Bungee&family=Pacifico&family=Major+Mono+Display" +
  "&text=" + encodeURIComponent(heroGlyphs) + "&display=block";

// Phones (under 768px) hide the slideshow; the <source> hands them a 1px placeholder
// so the real photos are never downloaded there.
const BLANK_GIF = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";

// Contents: the folder's index, one row per file.
const contents = [
  { num: "001", href: "/work/", page: "Work", title: "Case files", detail: `${pad2(projects.length)} cases` },
  { num: "002", href: "/capabilities/", page: "Capabilities", title: "Exhibit A", detail: `${capabilities.length} disciplines` },
  { num: "003", href: "/about/", page: "About", title: "Personnel file", detail: "Kurt Atoat" },
  { num: "004", href: "/experience/", page: "Experience", title: "Service record", detail: `${pad2(experience.length)} roles` },
  { num: "005", href: "/contact/", page: "Contact", title: "Request form", detail: "Open to work" },
];

// Homepage: "The Dossier", File No. 000: Cover Sheet. Styles: styles/home.css.
// Motion: HeroHeadline (glitch), HeroVisual (slideshow), HomeCover (stamp + contents).
export default function HomePage() {
  return (
    <>
      <link rel="stylesheet" href={glitchFontsHref} precedence="default" />

      {/* Hero Section Container: a full screen from md up; on phones (no slideshow) it sizes to its content
          so the contents index follows without a blank band. */}
      <main className="home-cover relative flex-1 md:min-h-[100svh] flex flex-col justify-between px-6 sm:px-12 md:px-24 lg:px-36 xl:pl-28 pt-12 pb-6 md:py-16 md:ml-24">
        {/* Printer's crop marks framing the cover sheet */}
        <span className="cover-crop cover-crop--tl" aria-hidden="true"></span>
        <span className="cover-crop cover-crop--tr" aria-hidden="true"></span>
        <span className="cover-crop cover-crop--bl" aria-hidden="true"></span>
        <span className="cover-crop cover-crop--br" aria-hidden="true"></span>

        {/* Top row: file label + "Open to work" stamp */}
        <div className="cover-top relative md:top-[16px]">
          <div className="cover-eyebrow opacity-0 animate-fade-up">
            <span className="cover-eyebrow-line"></span>
            <span>Cover sheet</span><span className="cover-eyebrow-sep">/</span><span>File No. 000</span>
          </div>
          {/* Desktop/tablet stamp (top right). On phones a second stamp sits beside "Open the file" instead. */}
          <span className="cover-stamp cover-stamp--top">Open to work</span>
        </div>

        {/* Hero row: text, then the visual. Stacked below xl; from xl a flex row where the visual
            takes the space the headline leaves (up to a max), so the two never overlap and stay
            vertically centred on each other. */}
        <div className="relative my-auto py-8 xl:flex xl:items-center xl:gap-[1.5vw] xl:-mr-28">

          {/* Main Hero Content with Staggered Fade Animations */}
          <div id="home" className="relative z-10 max-w-4xl xl:flex-none xl:w-[55%]">
            {/* Hover (or tap) a word to glitch it through other typefaces: components/home/HeroHeadline.tsx */}
            <h1 id="hero-headline" className="text-4xl md:text-6xl lg:text-7xl xl:text-[clamp(2.75rem,3.6vw,4.5rem)] font-bold tracking-tight leading-[1.1] mb-8 opacity-0 animate-fade-up delay-100">
              {heroLines.map((line) => (
                <span key={line.text} className={`${line.className} block`}>{line.text}</span>
              ))}
            </h1>

            <p className="text-gray-500 text-sm md:text-base max-w-lg mb-6 leading-relaxed font-normal opacity-0 animate-fade-up delay-200">
              I&apos;m a graphic designer and full-stack developer who loves creating meaningful brands and building functional, beautiful web experiences.
            </p>

            {/* Status line: the same facts as the About page ID card */}
            <p className="cover-status opacity-0 animate-fade-up delay-200">
              <span className="cover-status-item cover-status-open"><b className="cover-status-dot" aria-hidden="true"></b>Open to work</span>{" "}
              <span className="cover-status-item"><span className="cover-status-sep">&middot;</span>Lucena City, PH</span>{" "}
              <span className="cover-status-item"><span className="cover-status-sep">&middot;</span>3+ yrs</span>
            </p>

            {/* CTA row. On phones the "Open to work" stamp sits here, beside the button
                (and the status line drops its own "Open to work", which the stamp now says). */}
            <div className="cover-actions opacity-0 animate-fade-up delay-300">
              <Link href="/work/" className="cover-cta">
                <span>Open the file</span>
                <span className="cover-cta-icon" aria-hidden="true">&rarr;</span>
              </Link>
              <span className="cover-stamp cover-stamp--inline">Open to work</span>
            </div>
          </div>

          {/* Hero visual: construction lines + auto-playing brutalist slideshow (components/home/HeroVisual.tsx).
              Square box; card positions in styles/home.css, slot transforms in HeroVisual. */}
          <section id="hero-visual" className="hero-visual mx-auto mt-10 mb-20 w-[min(78vw,340px)] xl:m-0 xl:ml-auto xl:w-auto xl:flex-1 xl:min-w-0 xl:max-w-[720px]" aria-roledescription="carousel" aria-label="Brutalist architecture">
            {/* Construction grid (500x500 = the visual's box). The big circle frames both cards; the
                dots sit on the right vertical (x 455) where it meets that circle; the black marker caps the
                tick above the small circle, clear of the front card's top edge. */}
            <svg className="hero-lines" viewBox="0 0 500 500" aria-hidden="true">
              <circle className="draw" pathLength="1" cx="230" cy="250" r="245"></circle>
              <circle className="draw" pathLength="1" cx="140" cy="150" r="125"></circle>
              <line className="draw" pathLength="1" x1="455" y1="40" x2="455" y2="520"></line>
              <line className="draw" pathLength="1" x1="-50" y1="425" x2="455" y2="425"></line>
              <line className="draw" pathLength="1" x1="140" y1="-45" x2="140" y2="25"></line>
              <rect className="marker" x="135.5" y="-49.5" width="9" height="9"></rect>
              <rect className="marker-soft" x="450.5" y="420.5" width="9" height="9"></rect>
              <rect className="marker-soft" x="450.5" y="35.5" width="9" height="9"></rect>
            </svg>

            <div className="hero-stage">
              {heroSlides.map((slide, i) => (
                <figure key={slide.image} className="hero-card" role="group" aria-roledescription="slide" aria-label={`${i + 1} of ${heroSlides.length}`}
                  data-place={slide.place} data-photographer={slide.photographer}>
                  {/* A plain <img> rather than next/image: the <picture> source swap above is what keeps
                      phones from downloading these, and the files are already sized, greyscaled WebPs. */}
                  <picture>
                    <source media="(max-width: 767px)" srcSet={BLANK_GIF} />
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img src={`/assets/img/hero/${slide.image}`} alt={slide.alt} width="900" height="1200" decoding="async"
                      fetchPriority={i === 0 ? "high" : undefined} draggable="false" />
                  </picture>
                  <span className="hero-card-tape" aria-hidden="true">Fig. {pad2(i + 1)}</span>
                  <span className="hero-card-veil" aria-hidden="true"></span>
                </figure>
              ))}

              {/* Tilted to run along the front card's bottom edge (inside the stage so it moves with the cards) */}
              <p className="hero-caption">
                <span className="hero-caption-index">01 / {pad2(heroSlides.length)}</span> &mdash;{" "}
                <span className="hero-caption-place">{heroSlides[0].place}</span><br />
                Photo: <span className="hero-caption-credit">{heroSlides[0].photographer}</span> / Unsplash
              </p>
            </div>

            <div className="hero-dots">
              {heroSlides.map((slide, i) => (
                <button key={slide.image} type="button" className="hero-dot" aria-label={`Show slide ${i + 1}: ${slide.place}`}>
                  <span className="hero-dot-fill"></span>
                </button>
              ))}
            </div>
          </section>

        </div>{/* /hero row */}
      </main>

      {/* ============ Contents: the folder's index, one row per file. (Class is "cover-index", not
          "contents": that is a Tailwind utility for display: contents, which would erase the section's box.) ============ */}
      <section className="cover-index md:ml-24 px-6 sm:px-12 md:px-24 lg:px-36 xl:pl-28 pt-8 pb-8 md:pb-24" id="contents" aria-labelledby="contents-title">
        <div className="contents-head">
          <div className="cover-eyebrow">
            <span className="cover-eyebrow-line"></span>
            <h2 id="contents-title">Contents</h2>
          </div>
          <span className="contents-count">{contents.length} files</span>
        </div>

        <ol className="contents-list">
          {contents.map((item) => (
            <li key={item.num}>
              <Link className="contents-row" href={item.href}>
                <span className="contents-num">{item.num}</span>
                <span className="contents-page">{item.page}</span>
                <span className="contents-title">{item.title}</span>
                <span className="contents-detail">{item.detail}</span>
                <span className="contents-tape" aria-hidden="true">Open file &rarr;</span>
                <span className="contents-arrow" aria-hidden="true">&nearr;</span>
              </Link>
            </li>
          ))}
        </ol>

        <div className="contents-foot" aria-hidden="true">
          <span className="contents-bars"></span>
          <span className="contents-code">KA &middot; 000 &middot; LUC-PH</span>
        </div>
      </section>

      <HeroVisual />
      <HomeCover />
      <HeroHeadline />
    </>
  );
}
