import Link from "next/link";
import { contents } from "@/content/contents";

// The Dossier's index rows (styles/home.css): the homepage Contents section and the 404 page.
export default function ContentsList() {
  return (
    <ol className="contents-list">
      {contents.map((item) => (
        <li key={item.num}>
          <Link className="contents-row" href={item.href}>
            <span className="contents-num">{item.num}</span>
            <span className="contents-page">{item.page}</span>
            <span className="contents-title">{item.title}</span>
            <span className="contents-detail">{item.detail}</span>
            <span className="contents-tape" aria-hidden="true">Open file &rarr;</span>
            <span className="contents-arrow" aria-hidden="true">{"↗"}</span>
          </Link>
        </li>
      ))}
    </ol>
  );
}
