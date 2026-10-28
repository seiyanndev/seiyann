import type { Metadata } from "next";
import { contact } from "@/content/site";
import ContactMotion from "@/components/contact/ContactMotion";

export const metadata: Metadata = {
  title: "Contact: Request Form",
  description:
    "Request form: contact Kurt Atoat about a new project, a full-time role or a collaboration. Email, local time in Lucena City and social channels.",
};

const SUBJECTS = ["New project", "Full-time role", "Collaboration", "Just saying hi"];

/**
 * "The Dossier", File No. 005: Request Form. A "direct lines" card (email, local time,
 * channels) beside a printed request form with a rubber-stamp submit button.
 *
 * The form is sent to Web3Forms in the background (components/contact/ContactMotion.tsx), which emails
 * it on; a RECEIVED / RETURNED stamp lands on the form. Details: content/site.ts.
 * Styles: styles/contact.css.
 */
export default function ContactPage() {
  return (
    <main className="contact flex-1 px-6 sm:px-12 md:px-24 lg:px-36 pt-12 pb-24 md:ml-24">

      {/* ============ Header ============ */}
      <header className="ct-hero" id="ct-hero">
        <div className="ct-eyebrow">
          <span className="ct-eyebrow-line"></span>
          <span>Contact</span><span className="ct-eyebrow-sep">/</span><span>File No. 005</span>
        </div>
        <h1 className="ct-title">
          <span className="ct-line"><span>Open a file.</span></span>
          <span className="ct-line is-muted"><span>Let&apos;s work together.</span></span>
        </h1>
        <p className="ct-lede">Have a project in mind, a question, or just want to say hello? Fill in the request below, or reach me directly.</p>
      </header>

      <div className="ct-body" id="ct-body">

        {/* ============ Direct lines (ID-card style) ============ */}
        <aside className="ct-card" aria-label="Direct contact details">
          <span className="ct-card-label">Direct lines</span>

          <dl className="ct-fields">
            <div>
              <dt>Email</dt>
              <dd className="ct-email">
                <a href={`mailto:${contact.email}`}>{contact.email}</a>
                <button type="button" className="ct-copy" data-copy={contact.email} aria-label="Copy email address">
                  <span className="ct-copy-label">Copy</span>
                </button>
              </dd>
            </div>
            <div>
              <dt>Based in</dt>
              <dd>{contact.location}</dd>
            </div>
            <div>
              <dt>Local time</dt>
              <dd><span className="ct-clock" data-tz={contact.timezone}>&mdash;</span> <span className="ct-tz">PHT</span></dd>
            </div>
            <div>
              <dt>Status</dt>
              <dd><b className="ct-status-dot" aria-hidden="true"></b>Open to work &mdash; full-time or freelance</dd>
            </div>
          </dl>

          <span className="ct-card-label ct-card-label--channels">Channels</span>
          <ul className="ct-channels">
            {contact.socials.map((social) => (
              <li key={social.code}>
                <a href={social.url} target="_blank" rel="noopener">
                  <span className="ct-channel-code" aria-hidden="true">{social.code}</span>
                  <span className="ct-channel-name">{social.name}</span>
                  <span className="ct-channel-handle">@{social.handle}</span>
                  <span className="ct-channel-arrow" aria-hidden="true">&nearr;</span>
                </a>
              </li>
            ))}
          </ul>

          <div className="ct-barcode" aria-hidden="true">
            <span className="ct-barcode-bars"></span>
            <span className="ct-barcode-text">KA &middot; 005 &middot; LUC-PH</span>
          </div>
        </aside>

        {/* ============ Request form ============ */}
        <section className="req" id="request" aria-labelledby="req-title">
          <span className="req-tape" aria-hidden="true">Form 005 &mdash; Request</span>

          <header className="req-head">
            <h2 id="req-title" className="req-title">Request form</h2>
            <span className="req-form-no">Form 005</span>
          </header>

          {/* Result of the Web3Forms submission is shown here by ContactMotion */}
          <div className="req-live" id="req-live"></div>

          <form className="req-form" id="req-form" method="POST" data-email={contact.email}>
            {/* Honeypot: hidden from people. Bots that tick it are ignored (Web3Forms' "botcheck" field). */}
            <div className="req-hp" aria-hidden="true">
              <label>Not for people <input type="checkbox" name="botcheck" tabIndex={-1} autoComplete="off" /></label>
            </div>

            <div className="req-row">
              <label className="req-label" htmlFor="contact_name"><span className="req-num">01</span>Name <i>*</i></label>
              <input className="req-input" type="text" id="contact_name" name="contact_name" required autoComplete="name" placeholder="Your name" />
            </div>

            <div className="req-row">
              <label className="req-label" htmlFor="contact_email"><span className="req-num">02</span>Email <i>*</i></label>
              <input className="req-input" type="email" id="contact_email" name="contact_email" required autoComplete="email" placeholder="you@email.com" />
            </div>

            <fieldset className="req-row req-subjects">
              <legend className="req-label"><span className="req-num">03</span>Regarding</legend>
              <div className="req-options">
                {SUBJECTS.map((subject, i) => (
                  <label key={subject} className="req-option">
                    <input type="radio" name="contact_subject" value={subject} defaultChecked={i === 0} />
                    <span className="req-box" aria-hidden="true"></span>
                    <span>{subject}</span>
                  </label>
                ))}
              </div>
            </fieldset>

            <div className="req-row req-row--message">
              <label className="req-label" htmlFor="contact_message"><span className="req-num">04</span>Message <i>*</i></label>
              <textarea className="req-input req-message" id="contact_message" name="contact_message" rows={5} required placeholder="Tell me about your project, role or idea..."></textarea>
            </div>

            <div className="req-submit-row">
              <span className="req-note">* Required. Your details are only used to reply to you.</span>
              <button type="submit" className="req-stamp" id="req-submit">
                <span>File request</span>
              </button>
            </div>
          </form>
        </section>
      </div>

      {/* Sign-off, printed on a strip of tape. Full-bleed: negative margins cancel <main>'s padding and nav margin. */}
      <p className="ct-signoff -mx-6 sm:-mx-12 md:-mr-24 md:-ml-48 lg:-mr-36 lg:-ml-60" aria-hidden="true"><span>Good ideas. Better together. &mdash; Good ideas. Better together. &mdash; Good ideas. Better together. &mdash; Good ideas. Better together.</span></p>

      <ContactMotion />
    </main>
  );
}
