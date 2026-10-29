import type { CSSProperties } from "react";
import type { Metadata } from "next";
import { pageMetadata } from "@/lib/metadata";
import Image from "next/image";
import Link from "next/link";
import { projects } from "@/content/projects";
import { tools, onColor } from "@/content/tools";
import ToolIcon from "@/components/ToolIcon";
import AboutIntro from "@/components/about/AboutIntro";
import AboutTools from "@/components/about/AboutTools";

export const metadata: Metadata = pageMetadata({
  path: "/about/",
  og: "about",
  title: "About Kurt Atoat – Designer & Developer from Lucena City",
  description:
    "Meet Kurt Atoat, a graphic designer and full-stack developer from Lucena City, Philippines, with 5+ years in design, development and digital products.",
});

// Stats: projects and tools are counted from the real data so they never drift.
const stats = [
  { value: projects.length, suffix: "", label: "Projects completed", desc: "From brand identities to full-stack web applications." },
  { value: 5, suffix: "+", label: "Years of experience", desc: "In design, development, and digital product creation." },
  { value: tools.length, suffix: "", label: "Tools in the box", desc: "Languages, frameworks and apps I build with every day." },
  { value: 1, suffix: "", label: "Goal", desc: "To keep building, creating, and making an impact." },
];

// Two tapes crossing in an X, running in opposite directions (components/about/AboutTools.tsx).
const tapes = [
  { key: "ink", label: "Languages & frameworks", dir: -1 },
  { key: "paper", label: "Tools & apps", dir: 1 },
] as const;

/**
 * A "personnel file": headline + bio + pull quote on the left, a taped-on ID card on the right,
 * then the crossing toolbox tapes and a spec-sheet row of stats.
 * Styles: styles/about.css. Motion: components/about/AboutIntro.tsx (hero + stats), AboutTools.tsx (tapes).
 */
export default function AboutPage() {
  return (
    <main className="about flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-20 md:ml-24">

      {/* ============ Personnel file ============ */}
      <section className="about-hero" id="about-hero">

        {/* Left: headline, bio, approach, CTA */}
        <div className="about-text">
          <div className="about-eyebrow">
            <span className="about-eyebrow-line"></span>
            <span>About</span><span className="about-eyebrow-sep">/</span><span>File No. 003</span>
          </div>

          <h1 className="about-title">
            <span className="about-line"><span>Designing</span></span>
            <span className="about-line"><span>experiences.</span></span>
            <span className="about-line is-muted"><span>Building products.</span></span>
          </h1>

          <p className="about-bio about-reveal">
            I&apos;m a graphic designer and full-stack developer passionate about building digital experiences from concept to deployment. I enjoy blending strategy, branding, interface design, and engineering into products that are both functional and visually refined.
          </p>

          <figure className="about-quote about-reveal">
            <span className="about-quote-mark" aria-hidden="true">&ldquo;</span>
            <blockquote>I believe great products start with a clear problem, thoughtful design, and solid code.</blockquote>
            <figcaption>My approach</figcaption>
          </figure>

          <Link href="/work/" className="about-cta about-reveal">
            <span>View my work</span>
            <span className="about-cta-icon" aria-hidden="true">&rarr;</span>
          </Link>
        </div>

        {/* Right: ID card, taped to the page */}
        <div className="about-card-wrap">
          <article className="id-card" aria-label="Profile card">
            <span className="id-tape" aria-hidden="true">File 003 &mdash; Do not bend</span>

            <div className="id-photo">
              {/* unoptimized: the photo is cropped hard by object-fit: cover, and the resized, re-encoded copy
                  looked visibly softer than the original file the WordPress theme served. */}
              <Image src="/assets/aboutimg.jpg" alt="Kurt Atoat" width={800} height={1000} loading="eager" unoptimized />
              <span className="id-photo-tag" aria-hidden="true">Fig. 01</span>
            </div>

            <div className="id-name">
              Kurt Atoat
              <span>Designer &amp; Developer</span>
            </div>

            <dl className="id-fields">
              <div><dt>Role</dt><dd>Graphic Designer / Full-Stack Developer</dd></div>
              <div><dt>Based in</dt><dd>Lucena City, Philippines</dd></div>
              <div><dt>Focus</dt><dd>Brand &middot; UI/UX &middot; Code</dd></div>
              <div><dt>Status</dt><dd><b className="id-status-dot" aria-hidden="true"></b>Open to work &mdash; full-time or freelance</dd></div>
            </dl>

            <div className="id-barcode" aria-hidden="true">
              <span className="id-barcode-bars"></span>
              <span className="id-barcode-text">KA &middot; 003 &middot; LUC-PH</span>
            </div>
          </article>
        </div>
      </section>

      {/* ============ Toolbox ============
          Two tapes crossing in an X, running in opposite directions (components/about/AboutTools.tsx).
          Full-bleed: negative margins cancel <main>'s side padding and, from md, its 6rem nav margin too, so
          the tapes run to the screen's left edge under the floating nav. Tools come from content/tools.ts. */}
      <section className="tools -mx-6 sm:-mx-12 md:-mr-24 md:-ml-48 lg:-mr-36 lg:-ml-60" aria-label="Toolbox">
        <div className="tools-stage" aria-hidden="true">
          {tapes.map((tape) => {
            // Printed edge text: repeat the label to ~600 characters so it spans the tape (120% of the
            // screen) even on very wide displays, whatever the label's length.
            const edgeText = `${tape.label} — `.repeat(Math.ceil(600 / (tape.label.length + 3)));
            return (
              <div key={tape.key} className={`tape tape--${tape.key}`} data-dir={tape.dir}>
                <span className="tape-edge tape-edge--top">{edgeText}</span>
                <div className="tape-track">
                  <div className="tape-set">
                    {tools.filter((tool) => tool.tape === tape.key).map((tool) => (
                      <ToolChip key={tool.name} name={tool.name} icon={tool.icon} hex={tool.hex} />
                    ))}
                  </div>
                </div>
                <span className="tape-edge tape-edge--bottom">{edgeText}</span>
              </div>
            );
          })}
        </div>

        {/* The tapes are decorative duplicates; this is the readable list */}
        <ul className="sr-only">
          {tools.map((tool) => (
            <li key={tool.name}>{tool.name}</li>
          ))}
        </ul>
      </section>

      {/* ============ Stats: spec-sheet row (numbers count up in AboutIntro) ============ */}
      <dl className="about-stats" id="about-stats">
        {stats.map((stat) => (
          <div key={stat.label} className="about-stat">
            <dt className="about-stat-label">{stat.label}</dt>
            <dd className="about-stat-value"><span className="about-stat-num" data-count={stat.value}>{stat.value}</span>{stat.suffix}</dd>
            <dd className="about-stat-desc">{stat.desc}</dd>
          </div>
        ))}
      </dl>

      <AboutIntro />
      <AboutTools />
    </main>
  );
}

function ToolChip({ name, icon, hex }: { name: string; icon: string; hex: string }) {
  const style = { "--brand": hex, "--on-brand": onColor(hex) } as CSSProperties;
  return (
    <>
      <span className="tool" style={style}>
        <ToolIcon slug={icon} />
        <span className="tool-name">{name}</span>
      </span>
      <span className="tool-sep">&#10033;</span>
    </>
  );
}
