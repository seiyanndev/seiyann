import type { Metadata } from "next";
import { pageMetadata } from "@/lib/metadata";
import Link from "next/link";
import { capabilities, projectCaps } from "@/content/capabilities";
import { projects, pad2, projectHref } from "@/content/projects";
import CapabilitiesMotion from "@/components/capabilities/CapabilitiesMotion";

export const metadata: Metadata = pageMetadata({
  path: "/capabilities/",
  og: "capabilities",
  title: "Brand Identity, UI/UX Design & Web Development – Kurt Atoat",
  description:
    "Brand identity, UI/UX design, web development and end-to-end delivery by Kurt Atoat, each backed by real projects. Laravel, React, WordPress and more.",
});

// The markup behind the frame, typed out line by line (static, trusted HTML).
const CODE_LINES = [
  '<span class="t">&lt;h1</span> <span class="a">id</span>=<span class="s">"hero-headline"</span><span class="t">&gt;</span>',
  '  <span class="t">&lt;span&gt;</span>I design visual identities,<span class="t">&lt;/span&gt;</span>',
  '  <span class="t">&lt;span</span> <span class="a">class</span>=<span class="s">"muted"</span><span class="t">&gt;</span>build digital products,<span class="t">&lt;/span&gt;</span>',
  '<span class="t">&lt;/h1&gt;</span>',
  "",
  '<span class="t">&lt;a</span> <span class="a">href</span>=<span class="s">"/work/"</span> <span class="a">class</span>=<span class="s">"cta"</span><span class="t">&gt;</span>',
  '  View my work <span class="t">&lt;i&gt;</span>&amp;rarr;<span class="t">&lt;/i&gt;</span>',
  '<span class="t">&lt;/a&gt;</span>',
  "",
  '<span class="c">// glitch each word on hover</span>',
  '<span class="k">SplitText</span>.create(<span class="s">"#hero-headline"</span>, {',
  '  type: <span class="s">"words,chars"</span>',
  "});",
];
const codeHtml = CODE_LINES.map((line, n) => `<span class="lens-line"><span class="ln">${n + 1}</span>${line || " "}</span>`).join("");

/**
 * 1. "Lens" (pinned, scroll-driven): one real piece of work, this site's homepage, goes through four
 *    stages: brand mark → UI design → code → shipped. Each stage is one capability.
 * 2. Proof matrix: every project against every capability, so each claim links to real work.
 *
 * Data: content/capabilities.ts, content/projects.ts. Styles: styles/capabilities.css.
 * Motion: components/capabilities/CapabilitiesMotion.tsx.
 */
export default function CapabilitiesPage() {
  // How many projects back each capability (matrix footer).
  const capCounts = Object.fromEntries(capabilities.map((cap) => [cap.key, 0])) as Record<string, number>;
  projects.forEach((project) => projectCaps(project).forEach((cap) => { capCounts[cap]++; }));

  return (
    <main className="relative flex-1 md:ml-24">

      {/* ============ 1. Lens: brand → design → code → shipped ============ */}
      <section id="lens" className="lens-section" aria-label="Capabilities">
        <div className="lens-layout">

          {/* Left: intro + the four capabilities (the current stage is highlighted) */}
          <div className="lens-intro">
            <div className="lens-eyebrow">
              <span className="lens-eyebrow-line"></span>
              <span>Capabilities</span><span className="lens-eyebrow-sep">/</span><span>File No. 002</span>
            </div>
            <h1 className="lens-title">Design. Code. <span>Build.</span></h1>
            <p className="lens-lede">One project, four lenses. Scroll to watch this site go from a sketch to a shipped product.</p>

            <ol className="lens-steps" id="lens-steps">
              {capabilities.map((cap, i) => (
                <li key={cap.key} className={`lens-step${i === 0 ? " is-active" : ""}`} data-step={i}>
                  <button type="button" className="lens-step-head">
                    <span className="lens-step-box" aria-hidden="true"></span>
                    <span className="lens-step-num">{pad2(i + 1)}</span>
                    <span className="lens-step-title">{cap.title}</span>
                  </button>
                  <div className="lens-step-body">
                    <div className="lens-step-inner">
                      <p>{cap.summary}</p>
                      <ul>
                        {cap.deliverables.map((item) => (
                          <li key={item}>{item}</li>
                        ))}
                      </ul>
                    </div>
                  </div>
                </li>
              ))}
            </ol>
          </div>

          {/* Right: the artifact, filed as "Exhibit A" on a taped evidence sheet. Every layer is
              animated by the scrubbed timeline in CapabilitiesMotion; the caption follows the stage. */}
          <div className="lens-canvas-wrap">
            <figure className="lens-exhibit">
              <span className="lens-exhibit-tape" aria-hidden="true">Exhibit A &mdash; Seiyann</span>
              <span className="lens-crop lens-crop--tl" aria-hidden="true"></span>
              <span className="lens-crop lens-crop--tr" aria-hidden="true"></span>
              <span className="lens-crop lens-crop--bl" aria-hidden="true"></span>
              <span className="lens-crop lens-crop--br" aria-hidden="true"></span>
              <div className="lens-canvas" id="lens-canvas" aria-hidden="true">

                {/* 01 Brand: the monogram drawn from its construction grid */}
                <svg className="lens-brand" viewBox="0 0 400 300">
                  <g className="lens-construct">
                    <circle pathLength="1" cx="200" cy="150" r="110"></circle>
                    <circle pathLength="1" cx="150" cy="150" r="70"></circle>
                    <circle pathLength="1" cx="250" cy="150" r="70"></circle>
                    <line pathLength="1" x1="40" y1="150" x2="360" y2="150"></line>
                    <line pathLength="1" x1="200" y1="20" x2="200" y2="280"></line>
                    <line pathLength="1" x1="90" y1="205" x2="310" y2="205"></line>
                    <line pathLength="1" x1="90" y1="95" x2="310" y2="95"></line>
                  </g>
                  <g className="lens-mono">
                    <text x="200" y="205" textAnchor="middle"><tspan className="lens-mono-k">K</tspan><tspan>A</tspan></text>
                  </g>
                  <g className="lens-brand-labels">
                    <text x="40" y="140">x-height</text>
                    <text x="40" y="198">baseline</text>
                  </g>
                </svg>

                {/* 02 Design: a browser frame with this site's homepage, wireframe first */}
                <div className="lens-frame">
                  <div className="lens-frame-bar">
                    <i></i><i></i><i></i>
                    <span className="lens-live"><b></b>Live</span>
                  </div>
                  <div className="lens-frame-body">
                    <div className="lens-ui-nav">
                      <span className="lens-el lens-ui-logo"><span className="lens-skel"></span><span className="lens-real"><span className="k">K</span>A</span></span>
                      <span className="lens-el lens-ui-dot is-active"><span className="lens-skel"></span><span className="lens-real"></span></span>
                      <span className="lens-el lens-ui-dot"><span className="lens-skel"></span><span className="lens-real"></span></span>
                      <span className="lens-el lens-ui-dot"><span className="lens-skel"></span><span className="lens-real"></span></span>
                      <span className="lens-el lens-ui-dot"><span className="lens-skel"></span><span className="lens-real"></span></span>
                    </div>
                    <div className="lens-ui-main">
                      <span className="lens-el lens-ui-eyebrow"><span className="lens-skel"></span><span className="lens-real">Graphic Designer &amp; Full-Stack Developer</span></span>
                      <span className="lens-el lens-ui-h"><span className="lens-skel"></span><span className="lens-real">I design visual identities,</span></span>
                      <span className="lens-el lens-ui-h is-muted"><span className="lens-skel"></span><span className="lens-real">build digital products,</span></span>
                      <span className="lens-el lens-ui-h is-muted"><span className="lens-skel"></span><span className="lens-real">and turn ideas into real solutions.</span></span>
                      <span className="lens-el lens-ui-p"><span className="lens-skel"></span><span className="lens-real">I&apos;m a graphic designer and full-stack developer who loves creating meaningful brands.</span></span>
                      <Link className="lens-el lens-ui-btn" href="/work/" tabIndex={-1}>
                        <span className="lens-skel"></span>
                        <span className="lens-real"><i>&rarr;</i>View my work</span>
                      </Link>
                    </div>
                  </div>
                  <svg className="lens-cursor" viewBox="0 0 24 24"><path d="M4 2l16 9-7 2-3 7z"></path></svg>
                  <span className="lens-toast"><b></b>Deployed</span>
                </div>

                {/* 03 Code: the markup behind the frame, typed out line by line */}
                <pre className="lens-code"><code dangerouslySetInnerHTML={{ __html: codeHtml }} /></pre>
              </div>
              <figcaption className="lens-exhibit-foot">
                <span className="lens-exhibit-id">Exhibit A-<span id="lens-exhibit-num">01</span></span>
                <span className="lens-exhibit-label" id="lens-exhibit-label">{capabilities[0].title}</span>
                <span className="lens-exhibit-bars" aria-hidden="true"></span>
              </figcaption>
            </figure>
          </div>
        </div>

        {/* Stage progress (bottom of the pinned section) */}
        <div className="lens-progress" aria-hidden="true"><span id="lens-progress-fill"></span></div>
      </section>

      {/* ============ 2. Proof matrix ============ */}
      <section id="proof" className="proof-section" aria-labelledby="proof-title">
        <div className="proof-head">
          <div className="lens-eyebrow">
            <span className="lens-eyebrow-line"></span>
            <span>Proof</span><span className="lens-eyebrow-sep">/</span><span>Index B</span>
          </div>
          <h2 id="proof-title" className="proof-title">Every capability,<br /><span>backed by a project.</span></h2>
          <p className="proof-lede">Hover a capability to see where it was used. Select a project to open it.</p>
        </div>

        {/* Cross-reference index, printed on a taped sheet */}
        <div className="proof-sheet">
          <span className="proof-tape" aria-hidden="true">Index B &mdash; Cross-reference</span>
          <div className="proof-scroll">
            <table className="proof-table" id="proof-table">
              <thead>
                <tr>
                  <th scope="col" className="proof-col-num">#</th>
                  <th scope="col" className="proof-col-name">Project</th>
                  {capabilities.map((cap) => (
                    <th key={cap.key} scope="col" className="proof-cap" data-cap={cap.key} tabIndex={0}>
                      {cap.title}
                    </th>
                  ))}
                </tr>
              </thead>
              <tbody>
                {projects.map((project, i) => {
                  const caps = projectCaps(project);
                  const href = projectHref(i);
                  return (
                    <tr key={project.title} className="proof-row" data-caps={caps.join(" ")} data-href={href}>
                      <td className="proof-col-num">{pad2(i + 1)}</td>
                      <th scope="row" className="proof-col-name">
                        <Link href={href}>{project.title}</Link>{" "}
                        <span className="proof-tag">{project.tag}</span>
                      </th>
                      {capabilities.map((cap) => {
                        const has = caps.includes(cap.key);
                        return (
                          <td key={cap.key} className="proof-cell" data-cap={cap.key}>
                            <span className={`proof-mark${has ? " is-on" : ""}`} aria-hidden="true"></span>
                            <span className="sr-only">{has ? "Yes" : "No"}</span>
                          </td>
                        );
                      })}
                    </tr>
                  );
                })}
              </tbody>
              <tfoot>
                <tr>
                  <td className="proof-col-num"></td>
                  <th scope="row" className="proof-col-name">Projects</th>
                  {capabilities.map((cap) => (
                    <td key={cap.key} className="proof-count" data-cap={cap.key}>{pad2(capCounts[cap.key])}</td>
                  ))}
                </tr>
              </tfoot>
            </table>
          </div>
          <div className="proof-foot" aria-hidden="true">
            <span className="proof-foot-bars"></span>
            <span className="proof-foot-text">Source: project categories &middot; KA &middot; 002/B</span>
          </div>
        </div>
      </section>

      <CapabilitiesMotion />
    </main>
  );
}
