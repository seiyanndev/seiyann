import type { Metadata } from "next";
import Link from "next/link";
import { contents } from "@/content/contents";
import ContentsList from "@/components/ContentsList";

export const metadata: Metadata = {
  title: "File Not Found",
};

/**
 * 404, filed as "File No. 404": a MISSING stamp, a way back to the cover sheet, and the Dossier's
 * contents index. Reuses the Experience title styles and the homepage index (styles/experience.css,
 * styles/home.css); its own bits are in styles/not-found.css.
 */
export default function NotFound() {
  return (
    <main className="nf flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">
      <header className="nf-hero">
        <div className="nf-top">
          <div className="exp-eyebrow">
            <span className="exp-eyebrow-line"></span>
            <span>Error</span><span className="exp-eyebrow-sep">/</span><span>File No. 404</span>
          </div>
          <span className="nf-stamp">Missing</span>
        </div>

        <h1 className="exp-title">
          <span className="exp-line"><span>File not found.</span></span>
          <span className="exp-line is-muted"><span>Nothing is filed here.</span></span>
        </h1>

        <p className="exp-lede">This page isn&apos;t in the cabinet. It may have moved, or the link has a typo. Pick a file from the index below, or head back to the cover sheet.</p>

        <div className="cover-actions">
          <Link href="/" className="cover-cta">
            <span>Back to the cover sheet</span>
            <span className="cover-cta-icon" aria-hidden="true">&rarr;</span>
          </Link>
        </div>
      </header>

      <section className="cover-index nf-index" aria-labelledby="nf-index-title">
        <div className="contents-head">
          <div className="cover-eyebrow">
            <span className="cover-eyebrow-line"></span>
            <h2 id="nf-index-title">Contents</h2>
          </div>
          <span className="contents-count">{`${contents.length} files`}</span>
        </div>
        <ContentsList />
      </section>
    </main>
  );
}
