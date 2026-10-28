// Site-wide copy and details: homepage headline + slideshow, contact details, page titles.

// Homepage headline lines. Used by app/page.tsx for the markup and for the glitch-font subset,
// so editing the text here keeps both in sync.
export const heroLines = [
  { text: "I design visual identities,", className: "text-gray-900" },
  { text: "build digital products,", className: "hero-line-muted" },
  { text: "and turn ideas into real solutions.", className: "hero-line-muted" },
];

// Homepage hero slideshow (images in public/assets/img/hero/, cropped 3:4 and greyscaled).
// All photos are free under the Unsplash License (https://unsplash.com/license):
//   barbican  https://unsplash.com/photos/rEtsek-3HFk   bochum   https://unsplash.com/photos/p7vMzekHXrU
//   belgrade  https://unsplash.com/photos/P2uH1ASIYto   shanghai https://unsplash.com/photos/7WQlCMzGGI8
export const heroSlides = [
  { image: "brutalist-barbican.webp", place: "Barbican Estate, London", photographer: "Mike Hindle", alt: "Zig-zag concrete balconies of the Barbican towers in London" },
  { image: "brutalist-bochum.webp", place: "Ruhr University, Bochum", photographer: "Julia Taubitz", alt: "Rows of concrete columns under a raised deck at Ruhr University Bochum" },
  { image: "brutalist-belgrade.webp", place: "Belgrade, Serbia", photographer: "Goran Petkovic", alt: "Stacked weathered concrete volumes of a building in Belgrade" },
  { image: "brutalist-shanghai.webp", place: "1933 Old Millfun, Shanghai", photographer: "Declan Sun", alt: "Concrete ramps and bridges inside 1933 Old Millfun in Shanghai" },
];

// Contact details used across the site (Contact page "direct lines" card). The Web3Forms access key
// is not here: it comes from the NEXT_PUBLIC_WEB3FORMS_KEY environment variable (see .env.example).
export const contact = {
  email: "kurtcyrsfa@gmail.com",
  location: "Lucena City, Philippines",
  timezone: "Asia/Manila", // for the live local-time clock
  socials: [
    { code: "in", name: "LinkedIn", handle: "kurt-atoat", url: "https://www.linkedin.com/in/kurt-atoat/" },
    { code: "gh", name: "GitHub", handle: "seiyanndev", url: "https://github.com/seiyanndev" },
    { code: "ig", name: "Instagram", handle: "kurtcyrs", url: "https://www.instagram.com/kurtcyrs/" },
    { code: "fb", name: "Facebook", handle: "kurt.atoat.90", url: "https://www.facebook.com/kurt.atoat.90" },
  ],
};

export const siteName = "Kurt Atoat";
