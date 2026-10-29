import type { Metadata } from "next";
import Link from "next/link";
import { experience, type ExperienceRecord } from "@/content/experience";
import { projects, pad2, projectHref } from "@/content/projects";
import { tools } from "@/content/tools";
import ToolIcon from "@/components/ToolIcon";
import ExperienceMotion from "@/components/experience/ExperienceMotion";

export const metadata: Metadata = {
  title: "Experience: Service Record",
  description:
    "Service record: Kurt Atoat's roles in design, development and real-world projects, with the tools used and the work behind each one.",
};

// Lookups for a record's tools (with logos) and related projects (linked into the Work cabinet).
const toolsByName = new Map(tools.map((tool) => [tool.name, tool]));
const projectLinks = new Map(projects.map((project, i) => [project.title, projectHref(i)]));

const period = (record: ExperienceRecord) => `${record.start} — ${record.end === "" ? "Present" : record.end}`;

/**
 * "The Dossier", File No. 004: Service Record. Each role is a record card pulled from the file
 * (taped, stamped CURRENT / COMPLETED, ID-card style fields), with a sticky year index on the left.
 *
 * Data: content/experience.ts. Styles: styles/experience.css. Motion: components/experience/ExperienceMotion.tsx.
 */
export default function ExperiencePage() {
  const records = experience;

  return (
    <main className="exp flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

      {/* ============ Header ============ */}
      <header className="exp-hero" id="exp-hero">
        <div className="exp-eyebrow">
          <span className="exp-eyebrow-line"></span>
          <span>Experience</span><span className="exp-eyebrow-sep">/</span><span>File No. 004</span>
        </div>

        <h1 className="exp-title">
          <span className="exp-line"><span>Service record.</span></span>
          <span className="exp-line is-muted"><span>Where the work happened.</span></span>
        </h1>

        <p className="exp-lede">Building experience through design, development, and real-world projects.</p>

        {/* Record summary: same facts as the About page ID card */}
        <dl className="exp-summary">
          <div><dt>Experience</dt><dd>5+ years</dd></div>
          <div><dt>Roles on file</dt><dd>{pad2(records.length)}</dd></div>
          <div><dt>Status</dt><dd><b className="exp-status-dot" aria-hidden="true"></b>Open to work</dd></div>
          <div><dt>Based in</dt><dd>Lucena City, PH</dd></div>
        </dl>
      </header>

      {/* ============ Records ============ */}
      <div className="exp-body" id="exp-records">

        {/* Year index: sticky beside the records on desktop, a scrollable strip on phones */}
        <nav className="exp-index" aria-label="Records by year">
          <ol>
            {records.map((record, i) => (
              <li key={i}>
                <a href={`#record-${pad2(i + 1)}`} className={`exp-index-link${i === 0 ? " is-active" : ""}`} data-index={i}>
                  <span className="exp-index-num">{pad2(i + 1)}</span>
                  <span className="exp-index-year">{record.start}</span>
                </a>
              </li>
            ))}
          </ol>
        </nav>

        <div className="exp-records">
          {records.map((record, i) => {
            const num = pad2(i + 1);
            const isCurrent = record.end === "";
            const meta = [record.type, record.location].filter(Boolean);

            return (
              <article key={i} className="rec" id={`record-${num}`} data-index={i} aria-labelledby={`rec-role-${num}`}>
                <span className="rec-tape" aria-hidden="true">{`Record ${num} — ${record.start}`}</span>

                <header className="rec-head">
                  <span className="rec-num">{`Record ${num}`}</span>
                  <h2 className="rec-role" id={`rec-role-${num}`}>{record.role}</h2>
                  <p className="rec-org">
                    {meta.length > 0 ? `${record.org} ` : record.org}
                    {meta.length > 0 && <span>{`· ${meta.join(" · ")}`}</span>}
                  </p>
                  <span className={`rec-stamp${isCurrent ? " is-current" : ""}`}>{isCurrent ? "Current" : "Completed"}</span>
                </header>

                <dl className="rec-fields">
                  <div>
                    <dt>Period</dt>
                    <dd>{period(record)}</dd>
                  </div>
                  {record.duties.length > 0 && (
                    <div>
                      <dt>Duties</dt>
                      <dd>
                        <ol className="rec-duties">
                          {record.duties.map((duty, d) => (
                            <li key={d}><span className="rec-duty-num">{pad2(d + 1)}</span><span className="rec-duty-text">{duty}</span></li>
                          ))}
                        </ol>
                      </dd>
                    </div>
                  )}
                  {record.tools.length > 0 && (
                    <div>
                      <dt>Tools</dt>
                      <dd className="rec-tools">
                        {record.tools.map((toolName) => {
                          const tool = toolsByName.get(toolName);
                          return (
                            <span key={toolName} className="rec-tool">
                              {tool && <ToolIcon slug={tool.icon} />}
                              {toolName}
                            </span>
                          );
                        })}
                      </dd>
                    </div>
                  )}
                  {record.projects.length > 0 && (
                    <div>
                      <dt>Proof</dt>
                      <dd className="rec-proof">
                        {record.projects.map((title) => {
                          const href = projectLinks.get(title);
                          return href ? <Link key={title} href={href}>{`${title} →`}</Link> : null;
                        })}
                      </dd>
                    </div>
                  )}
                </dl>

                <footer className="rec-foot" aria-hidden="true">
                  <span className="rec-barcode"></span>
                  <span className="rec-code">{`REC-${num} · ${record.start}`}</span>
                </footer>
              </article>
            );
          })}
        </div>
      </div>

      <ExperienceMotion />
    </main>
  );
}
