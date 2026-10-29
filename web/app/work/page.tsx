import type { CSSProperties } from "react";
import type { Metadata } from "next";
import { pageMetadata } from "@/lib/metadata";
import Image from "next/image";
import { projects, pad2 } from "@/content/projects";
import WorkCabinet from "@/components/work/WorkCabinet";

export const metadata: Metadata = pageMetadata({
  path: "/work/",
  og: "work",
  title: "Work: Case Files",
  description:
    "Case files: selected brand identity, UI/UX and web development work by Kurt Atoat, from farm-to-table marketplaces to point-of-sale systems.",
});

// Discipline filters, matched against each project's category text.
const FILTERS = [
  { key: "all", label: "All", match: "" },
  { key: "branding", label: "Branding", match: "Branding" },
  { key: "ui", label: "UI/UX", match: "UI-UX" },
  { key: "web", label: "Web", match: "Web Development" },
];
const matches = (category: string, match: string) => category.toLowerCase().includes(match.toLowerCase());

// Tabs step across the folder width so neighbouring tabs never sit on top of each other.
// Unitless on purpose: work.css scales them (0 = left edge, 72 = right edge).
const TAB_POSITIONS = [0, 24, 48, 72];

/**
 * "The Dossier", File No. 001: Case Files, shown as a filing cabinet. Each project is a manila
 * folder standing in a drawer; tabs are staggered so they all show. Clicking a folder opens it in
 * place into its case sheet (exhibit + fields); filter stamps dim folders outside a discipline.
 *
 * Data: content/projects.ts. Styles: styles/work.css. Motion: components/work/WorkCabinet.tsx.
 * Deep links: /work/#project-05 opens case 05 (used by the Capabilities matrix).
 */
export default function WorkPage() {
  const total = projects.length;
  const filterCounts = FILTERS.map((filter) =>
    filter.match === "" ? total : projects.filter((p) => matches(p.category, filter.match)).length
  );

  return (
    <main className="cab flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

      {/* ============ Header ============ */}
      <header className="cab-hero" id="cab-hero">
        <div className="cab-eyebrow">
          <span className="cab-eyebrow-line"></span>
          <span>Work</span><span className="cab-eyebrow-sep">/</span><span>File No. 001</span>
        </div>
        <h1 className="cab-title">
          <span className="cab-line"><span>Case files.</span></span>
          <span className="cab-line is-muted"><span>Selected work.</span></span>
        </h1>
        <p className="cab-lede">{`${total} cases on file. Pull a folder from the drawer to open it.`}</p>

        {/* Filter stamps: dim the folders outside a discipline */}
        <div className="cab-filters" role="group" aria-label="Filter cases by discipline">
          {FILTERS.map((filter, i) => (
            <button key={filter.key} type="button" className={`cab-filter${filter.key === "all" ? " is-active" : ""}`} data-filter={filter.key} aria-pressed={filter.key === "all" ? "true" : "false"}>
              {`${filter.label} `}<span>{pad2(filterCounts[i])}</span>
            </button>
          ))}
        </div>
      </header>

      {/* ============ The drawer ============ */}
      <div className="cab-drawer" id="cab-drawer">
        <div className="cab-drawer-label" aria-hidden="true">
          <span>Drawer 01 &mdash; Selected work</span>
          <span>{`${pad2(total)} folders`}</span>
        </div>

        <ol className="cab-folders">
          {projects.map((project, i) => {
            const number = pad2(i + 1);
            const [variant, c1, c2, c3, c4] = project.art;
            const keys = FILTERS.filter((f) => f.match !== "" && matches(project.category, f.match)).map((f) => f.key);
            const folderStyle = { "--tab-x": TAB_POSITIONS[i % TAB_POSITIONS.length], "--z": i + 1 } as CSSProperties;
            const artStyle = { "--c1": c1, "--c2": c2, "--c3": c3, "--c4": c4 } as CSSProperties;

            return (
              <li key={project.title} className="folder" id={`project-${number}`} data-filters={keys.join(" ")} style={folderStyle}>

                {/* Tab + front strip: the whole thing is the toggle */}
                <button type="button" className="folder-toggle" aria-expanded="false" aria-controls={`case-${number}`}>
                  <span className="folder-tab"><b>{number}</b>{` · ${project.title}`}</span>
                  <span className="folder-front">
                    <span className="folder-num">{number}</span>
                    <span className="folder-title">{project.title}</span>
                    <span className="folder-meta">
                      <span className="folder-tag">{project.tag}</span>
                      <span className="folder-summary">{project.summary}</span>
                    </span>
                    <span className="folder-action" aria-hidden="true"><span className="folder-action-open">Open</span><span className="folder-action-close">Close</span></span>
                  </span>
                </button>

                {/* Case sheet, revealed when the folder opens */}
                <div className="folder-body" id={`case-${number}`} role="region" aria-label={`${project.title} case file`}>
                  <div className="folder-inner">
                    <div className="case-sheet">
                      <figure className="case-exhibit">
                        {project.image && project.imageSize ? (
                          <Image src={`/assets/${project.image}`} alt={`${project.title} preview`}
                            width={project.imageSize.width} height={project.imageSize.height}
                            sizes="(min-width: 768px) 50vw, 100vw" />
                        ) : (
                          <span className={`ff-art art-${variant}`} style={artStyle}></span>
                        )}
                        <span className="case-tape" aria-hidden="true">{`Case ${number} / ${pad2(total)}`}</span>
                        <figcaption className="case-fig">{`Fig. ${number}`}</figcaption>
                      </figure>

                      <div className="case-info">
                        <dl className="case-fields">
                          <div><dt>Case</dt><dd>{`${number} / ${pad2(total)}`}</dd></div>
                          <div><dt>Discipline</dt><dd>{project.category}</dd></div>
                          <div><dt>Type</dt><dd>{project.tag}</dd></div>
                          <div><dt>Overview</dt><dd className="case-desc">{project.description}</dd></div>
                        </dl>
                        <div className="case-foot">
                          <span className="case-barcode" aria-hidden="true"></span>
                          <button type="button" className="case-close">Close file</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
            );
          })}
        </ol>

        <div className="cab-drawer-base" aria-hidden="true"></div>
      </div>

      <WorkCabinet />
    </main>
  );
}
