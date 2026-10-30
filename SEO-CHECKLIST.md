# SEO implementation checklist

| Requirement | Status | Location / action |
|---|---|---|
| Focus keyword in title | Draft implemented | `src/components/SEO.tsx`; verify title length after final subdomain/brand review |
| Meta description 120–156 chars | Draft implemented, must validate | `SEO.tsx`; exact count to validate before launch |
| One H1 | Implemented | `src/App.tsx` hero |
| H2/H3 hierarchy | Implemented | `src/App.tsx` sections and cards |
| Focus keyword in first 10% | Implemented | Hero H1 and introductory content |
| Keyword in URL slug | Root URL used | Confirm chosen subdomain and final keyword angle |
| Keyword-bearing image alt | Partial | Logo alt is brand-only; add a real relevant image with descriptive keyword alt if appropriate |
| Keyword density 0.5–1.5% | Not validated | Run language-specific content analysis after final copy review; avoid stuffing |
| 1,200+ words per language | Not yet verified | Draft is intentionally concise; expand with verified unique content before launch |
| Readability targets | Draft | Review English readability metrics and Arabic equivalents |
| Internal links | Partial | Parent links present; reciprocal contextual link must be added to parent site |
| 2+ authoritative external sources | Not implemented | Add verified UAE MOFA and relevant official authority links after current process review |
| Canonical | Implemented with placeholder host | `SEO.tsx`; replace `[SUBDOMAIN]` |
| Hreflang en/ar/x-default | Implemented with placeholder host | `SEO.tsx`, `sitemap.xml`; verify reciprocity |
| Open Graph/Twitter | Partial | Tags present; 1200×630 EN/AR image assets still required |
| JSON-LD | Partial | Organization, LocalBusiness, Service, WebSite, BreadcrumbList, FAQPage, HowTo. Validate; add verified geo/openingHours only when supplied |
| No review/rating schema | Implemented | `src/lib/seo.ts` deliberately excludes both |
| robots and sitemap | Implemented with placeholder host | `public/robots.txt`, `public/sitemap.xml` |
| Prerendered HTML | Implemented in build pipeline | `scripts/prerender.mjs`; verify generated `/` and `/ar/` snapshots |
| Image formats and dimensions | Partial | Logo asset needs replacement/optimization; add dimensions to any real imagery |
| Accessibility | Partial | Semantic structure, labels, focus styles, details/summary; audit chatbot focus trap and all keyboard flows before launch |
| Core Web Vitals | Not measured | Run Lighthouse and field monitoring after deployment |

Approximate translation-file text counts (including FAQ answers and interface labels): English 1,701 words; Arabic 1,502 Arabic/Latin word tokens. These are source JSON text counts, not a final crawler-extracted body-word audit. Recheck rendered visible copy after native Arabic review.
