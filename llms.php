<?php
/** llms.txt (https://llmstxt.org) - served at /llms.txt (see .htaccess).
 *  Course facts come from the Codeksha Course Catalogue; keep them in sync with the course pages. */
require __DIR__ . '/inc/site-urls.php';

header('Content-Type: text/plain; charset=UTF-8');
$base = ck_site_base();
$root = __DIR__;

/** Pull a readable title from a page's <title> tag. */
$title = function (string $file) use ($root): string {
    $html = @file_get_contents($root . '/' . $file, false, null, 0, 2048) ?: '';
    if (preg_match('/<title>(.*?)<\/title>/is', $html, $m)) {
        $t = html_entity_decode($m[1], ENT_QUOTES | ENT_HTML5);
        $t = preg_replace('/\s*[|\x{2013}\x{2014}].*$/u', '', $t);   // drop " | ..." / " - ..."
        $t = preg_replace('/\s+Course\s+in\s+Rajkot.*$/i', '', $t);
        return trim($t);
    }
    return ucwords(str_replace('-', ' ', pathinfo($file, PATHINFO_FILENAME)));
};

echo "# Codeksha\n\n";
echo "> Codeksha is an IT training institute in Rajkot, Gujarat, India. It offers live classroom courses in "
   . "full stack, frontend and backend web development, SEO, advanced SEO and AI search (GEO, AEO), digital marketing, "
   . "AI automation and AI agents, and graphic design with UI/UX. Courses run 3 to 5 months, about 2 hours a day, 5 days a week.\n\n";
echo "Every course includes live projects, portfolio and resume support, a Codeksha course certificate, an internship "
   . "opportunity for eligible students, and mock interviews with freelancing basics. Free demo classes are available.\n\n";

$catalog = <<<'TXT'
## Courses at a glance

All courses are live classroom training at the Codeksha centre in Rajkot, about 2 hours a day, 5 days a week. Weekend and fast-track batches can be scaled from the same plan.

| Course | Duration | Who it's for | Job role after |
| --- | --- | --- | --- |
| [Full Stack Web Development]({BASE}/course/full-stack-web-development/) | 5 months | Beginners, no coding needed | Full Stack Developer (PHP) |
| [Frontend Development with CMS]({BASE}/course/frontend-development/) | 3 months | Beginners | Frontend / WordPress / Shopify Developer |
| [Backend Development]({BASE}/course/backend-development/) | 4 months | Basic HTML/JS helps | Backend / PHP / Laravel Developer |
| [SEO Foundation (Basic)]({BASE}/course/seo/) | 3 months | Beginners | SEO Executive |
| [Advanced SEO & AI Search]({BASE}/course/advanced-seo-ai-search/) | 3 months | After Basic SEO or 6+ months SEO work | SEO Specialist |
| [Digital Marketing Pro (SEO + Paid Ads)]({BASE}/course/digital-marketing-seo/) | 4 months | Beginners | Digital Marketing Executive |
| [AI Automation & AI Agents]({BASE}/course/ai-automation/) | 3 months | Beginners, no coding needed to start | AI Automation Specialist |
| [Graphic Design & UI/UX]({BASE}/course/graphic-design-ui-ux/) | 3 months | Beginners | Graphic Designer / UI-UX Designer |

Every course includes live projects on real or real-style briefs, portfolio and resume support, a Codeksha course certificate, an internship opportunity for eligible students, and mock interviews with freelancing basics (Upwork, OnlineJobs.ph, LinkedIn).

## Course details

### Full Stack Web Development

- URL: {BASE}/course/full-stack-web-development/
- Duration: 5 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners, no coding needed
- Job role after: Full Stack Developer (PHP)
- Framework: Laravel, CodeIgniter or Node.js (pick one)
- Summary: The Full Stack Web Development course at Codeksha is a 5-month classroom program in Rajkot for beginners. You learn HTML5, CSS3, Bootstrap 5 and JavaScript, then PHP and MySQL, one framework of your choice (Laravel, CodeIgniter or Node.js), and DevOps with a CI/CD pipeline, finishing with a live capstone app deployed on a server.
- Curriculum:
  - Month 1, Web foundations and design basics: HTML5: semantic tags, forms, SEO-friendly markup; CSS3, Flexbox, Grid, responsive design; Bootstrap 5 layouts and components; Design basics: colour, typography, spacing, reading a Figma file
  - Month 2, JavaScript and version control: JavaScript ES6+: variables, functions, arrays, objects, DOM, events; Fetch API, JSON, form validation; jQuery and Ajax; Git and GitHub: commits, branches, pull requests
  - Month 3, PHP and MySQL: PHP core: syntax, forms, sessions, cookies, file uploads; OOP in PHP; MySQL: tables, relations, queries, CRUD
  - Month 4, Framework track: Laravel, CodeIgniter or Node.js (pick one): MVC, routing, controllers, views, models; Authentication, middleware, validation; REST APIs and Ajax-driven pages
  - Month 5, DevOps, deployment, capstone and job prep: Linux basics, VPS and server setup (Apache/Nginx); Domains, DNS, SSL; CI/CD pipeline with GitHub Actions (auto-deploy on push); Docker introduction, backups, security basics; Live project: full app with admin panel (e-commerce, booking or CRM), deployed with CI/CD on a live server; GitHub portfolio, resume, mock interviews
- Projects: Portfolio site, Blog / CMS, Capstone web app with admin panel

### Frontend Development with CMS

- URL: {BASE}/course/frontend-development/
- Duration: 3 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners
- Job role after: Frontend / WordPress / Shopify Developer
- CMS: WordPress, Shopify, Webflow or Wix (pick one)
- Summary: The Frontend Development with CMS course at Codeksha is a 3-month classroom program in Rajkot for beginners. You learn HTML5, CSS3, Bootstrap 5 and JavaScript with GitHub, then build and launch a full site on one CMS of your choice (WordPress, Shopify, Webflow or Wix) and auto-deploy with CI/CD.
- Curriculum:
  - Month 1, HTML, CSS and Bootstrap: HTML5, CSS3, Flexbox, Grid; Responsive, mobile-first layouts; Bootstrap 5
  - Month 2, JavaScript and GitHub: JavaScript essentials, DOM, events; Sliders, tabs, modals, form validation; Git and GitHub
  - Month 3, CMS track and deployment: Theme setup, page builders, custom sections; Plugins/apps, forms, basic speed and on-page SEO; CI/CD for frontend: auto-deploy to Netlify, Vercel or GitHub Pages; Client handover and site launch checklist
- Projects: Landing page, Responsive business site, Full site in the chosen CMS

### Backend Development

- URL: {BASE}/course/backend-development/
- Duration: 4 months (about 2 hours a day, 5 days a week)
- Who it's for: Basic HTML/JS helps
- Job role after: Backend / PHP / Laravel Developer
- Framework: Laravel, CodeIgniter or Node.js (pick one)
- Summary: The Backend Development course at Codeksha is a 4-month classroom program in Rajkot. You learn PHP and MySQL, one framework of your choice (Laravel, CodeIgniter or Node.js), REST APIs, Ajax, jQuery and web security, then deploy an API-based capstone app with Linux, CI/CD and Docker basics. Basic HTML/JS knowledge helps.
- Curriculum:
  - Month 1, PHP and MySQL: PHP core, OOP, sessions, file handling; MySQL design, joins, CRUD
  - Month 2, Framework track: Laravel, CodeIgniter or Node.js (pick one): MVC, routing, ORM, migrations; Authentication, roles, validation
  - Month 3, APIs, Ajax and jQuery: REST API build and testing (Postman); Ajax and jQuery for dynamic pages; Security: SQL injection, XSS, CSRF; Git and GitHub team workflow
  - Month 4, DevOps and capstone: Linux, VPS, Nginx/Apache setup; CI/CD pipeline with GitHub Actions; Docker basics, logs, backups; Capstone: API-based app deployed live
- Projects: REST API, Admin panel, Deployed capstone app

### SEO Foundation (Basic)

- URL: {BASE}/course/seo/
- Duration: 3 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners
- Job role after: SEO Executive
- Summary: The SEO Foundation (Basic) course at Codeksha is a 3-month classroom program in Rajkot for beginners. It covers how search engines crawl, index and rank, keyword research, on-page, basic technical, off-page and local SEO, and SEO tools (Search Console, GA4, Ahrefs/Semrush, Looker Studio), ending with an audit and a 30-day SEO plan for a live site.
- Curriculum:
  - Module 1, Introduction to SEO: How search engines crawl, index and rank
  - Module 2, Keyword research: Search intent; Search volume; Keyword difficulty; Keyword tools
  - Module 3, On-page SEO: Titles; Meta descriptions; Headings; Content; Internal links
  - Module 4, Basic technical SEO: Sitemaps; robots.txt; Indexing; Speed; Mobile
  - Module 5, Off-page SEO: Backlinks; Citations; Guest posts
  - Module 6, Local SEO fundamentals: Google Business Profile; Local citations; Reviews
  - Module 7, SEO tools and reporting: Google Search Console; GA4; Ahrefs / Semrush; Looker Studio
  - Module 8, Final project: SEO audit of a live site; 30-day SEO plan for that site
- Projects: SEO audit of a live site, 30-day SEO plan

### Advanced SEO & AI Search

- URL: {BASE}/course/advanced-seo-ai-search/
- Duration: 3 months (about 2 hours a day, 5 days a week)
- Who it's for: After Basic SEO or 6+ months SEO work
- Job role after: SEO Specialist
- Summary: The Advanced SEO & AI Search course at Codeksha is a 3-month classroom program in Rajkot for people who have finished Basic SEO or have 6+ months of SEO work. It covers SEO content writing, advanced technical SEO, schema, ecommerce SEO, end-to-end audits, AI SEO, GEO and AEO (ranking in ChatGPT, Gemini, Perplexity and AI Overviews) and SEO automation.
- Curriculum:
  - Module 1, SEO content writing: Content briefs; Topical authority; E-E-A-T
  - Module 2, Advanced technical SEO: Core Web Vitals; JavaScript SEO; Crawl budget; Site migrations
  - Module 3, Advanced on-page, off-page and schema markup: Advanced on-page SEO; Advanced off-page SEO; Schema markup
  - Module 4, Ecommerce SEO: Category pages; Product pages; Faceted navigation
  - Module 5, SEO auditing end to end: Running a complete SEO audit
  - Module 6, AI SEO, GEO and AEO: Ranking in ChatGPT; Ranking in Gemini; Ranking in Perplexity; Google AI Overviews
  - Module 7, SEO automation: n8n; Google Sheets; AI workflows for reports and content
  - Module 8, Final project: Full SEO audit; AI visibility report for a real business
- Projects: Full SEO audit, AI visibility report for a real business

### Digital Marketing Pro (SEO + Paid Ads)

- URL: {BASE}/course/digital-marketing-seo/
- Duration: 4 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners
- Job role after: Digital Marketing Executive
- Summary: The Digital Marketing Pro (SEO + Paid Ads) course at Codeksha is a 4-month classroom program in Rajkot for beginners. It covers basic and advanced SEO including AI SEO, GEO and AEO, ad creatives in Canva and with AI tools, Meta Ads, Google Ads (Search, Display, Performance Max, YouTube) and ChatGPT Ads, ending with a live small-budget campaign and results report.
- Curriculum:
  - Month 1, Basic SEO: Introduction to SEO, keyword research, on-page, off-page; Basic technical SEO, SEO tools and reporting
  - Month 2, Advanced SEO: Advanced technical SEO; Advanced keyword research and strategy; AI SEO, GEO and AEO
  - Month 3, Ad creatives and Meta Ads: Ad creatives in Canva and with AI tools (images, copy, short video); Meta Ads: Business Manager, Pixel, campaign objectives, audiences, retargeting
  - Month 4, Google Ads, ChatGPT Ads and capstone: Google Ads: Search, Display, Performance Max, YouTube, conversion tracking; ChatGPT Ads (new channel: how it works and when to test it); Budgeting, A/B testing, client reporting; Capstone: live small-budget campaign with results report
- Projects: Live small-budget campaign with results report

### AI Automation & AI Agents

- URL: {BASE}/course/ai-automation/
- Duration: 3 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners, no coding needed to start
- Job role after: AI Automation Specialist
- Summary: The AI Automation & AI Agents course at Codeksha is a 3-month classroom program in Rajkot for beginners, with no coding needed to start. You learn AI tools (ChatGPT, Claude, Gemini), prompt engineering and coding fundamentals, build workflows in n8n, Zapier and Make.com, create AI agents and business automations, and deploy them on a VPS.
- Curriculum:
  - Month 1, Foundations: AI and automation fundamentals; Using AI tools professionally (ChatGPT, Claude, Gemini); Coding fundamentals for automation: JavaScript basics, JSON, APIs, webhooks; Prompt engineering
  - Month 2, Building workflows: Markdown files, AI instructions and context files; Custom AI skills and integrations (APIs, MCP); Workflows in n8n, Zapier and Make.com
  - Month 3, Agents, real projects and deployment: AI agents for real-world tasks; Automating job search and freelance client discovery; Business automations: lead generation, CRM, email/WhatsApp follow-ups, reports; Deploying and maintaining projects (self-hosted n8n on a VPS, error handling, monitoring)
- Projects: Job-hunt automation, Lead-gen agent, One business automation for a real client

### Graphic Design & UI/UX

- URL: {BASE}/course/graphic-design-ui-ux/
- Duration: 3 months (about 2 hours a day, 5 days a week)
- Who it's for: Beginners
- Job role after: Graphic Designer / UI-UX Designer
- Summary: The Graphic Design & UI/UX course at Codeksha is a 3-month classroom program in Rajkot for beginners. You learn design basics, Canva, Photoshop and Illustrator with brand identity work, then UX basics, Figma and Claude Design, and finish with a portfolio on Behance or Dribbble.
- Curriculum:
  - Month 1, Design basics, Canva and Photoshop: Colour, typography, layout, hierarchy; Canva: social posts, ads, brochures, presentations; Photoshop: photo editing, retouching, banners, manipulation
  - Month 2, Illustrator and branding: Vector design, logos, icons; Brand identity kit: logo, colours, fonts, stationery
  - Month 3, UI/UX with Figma and Claude Design: UX basics: user research, user flows, wireframes; Figma: components, auto layout, prototyping, design systems; Claude Design: AI-assisted mockups and quick design options; Final portfolio (Behance / Dribbble)
- Projects: Social media kit, Brand identity, Mobile app or website UI

## Common questions

- **Where is Codeksha?** A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006, India. All training is in-person at this centre.
- **How long are Codeksha courses?** Full Stack Web Development is 5 months; Backend Development and Digital Marketing Pro are 4 months; Frontend Development with CMS, SEO Foundation (Basic), Advanced SEO & AI Search, AI Automation & AI Agents, and Graphic Design & UI/UX are 3 months each.
- **What is the daily schedule?** About 2 hours a day, 5 days a week. Weekend and fast-track batches can be scaled from the same plan.
- **Which course should a beginner with no coding background take?** Full Stack Web Development (no coding needed), Frontend Development with CMS, Digital Marketing Pro, SEO Foundation (Basic), AI Automation & AI Agents (no coding needed to start) or Graphic Design & UI/UX.
- **Does Codeksha teach GEO and AEO?** Yes. AI SEO, GEO (Generative Engine Optimization) and AEO (Answer Engine Optimization), including ranking in ChatGPT, Gemini, Perplexity and AI Overviews, are covered in Advanced SEO & AI Search and in Digital Marketing Pro.
- **Do students get a certificate?** Yes, every course includes a Codeksha course certificate, plus an internship opportunity for eligible students.
- **How much are the fees?** Fees depend on the batch. Call +91 63555 59016 or request a call back on the website; a free demo class is available before joining.

TXT;
echo str_replace('{BASE}', $base, $catalog) . "\n";

echo "## Topic courses\n\n";
$desc = ['graphic-design' => 'Design basics, Canva, Photoshop, Illustrator and a brand identity kit.', 'ui-ux-design' => 'UX basics, Figma prototyping and design systems, Claude Design and a portfolio.', 'wordpress-development' => 'Theme setup, page builders, plugins, forms, speed and on-page SEO, and site launch.', 'javascript' => 'ES6+, DOM and events, Fetch API and JSON, form validation, jQuery, Ajax and GitHub.', 'google-ads' => 'Search, Display, Performance Max and YouTube campaigns, tracking, testing and reporting.', 'social-media-marketing' => 'Canva and AI ad creatives, Meta Ads, audiences, retargeting and reporting.', 'n8n-automation' => 'n8n, Zapier and Make.com workflows, APIs and webhooks, business automations, self-hosting.', 'prompt-engineering' => 'ChatGPT, Claude and Gemini, prompt engineering, context files, custom AI skills and MCP.'];
foreach (['graphic-design', 'ui-ux-design', 'google-ads', 'social-media-marketing', 'javascript', 'mongodb', 'n8n-automation', 'prompt-engineering', 'wordpress-development'] as $slug) {
    if (is_file($root . '/course/' . $slug . '.php')) {
        echo "- [" . $title('course/' . $slug . '.php') . "]({$base}/course/{$slug}/)" . (isset($desc[$slug]) ? ': ' . $desc[$slug] : '') . "\n";
    }
}
echo "- [All courses]({$base}/courses/): full course catalogue\n\n";

echo "## Key pages\n\n";
echo "- [Book a free demo class]({$base}/book-demo/): reserve a seat in a live session\n";
echo "- [IT training in Rajkot]({$base}/it-training-rajkot/): overview of the institute and approach\n";
echo "- [About Codeksha]({$base}/about-us/): who we are and how we teach\n";
echo "- [Gallery]({$base}/gallery/): photos from the training centre\n";
echo "- [FAQs]({$base}/faqs/): common questions about courses, fees and admissions\n";
echo "- [Contact]({$base}/contact/): phone, email and address\n\n";

echo "## Guides & articles\n\n";
foreach (glob($root . '/blog/*.php') as $f) {
    $slug = basename($f, '.php');
    echo "- [" . $title('blog/' . $slug . '.php') . "]({$base}/blog/{$slug}/)\n";
}
echo "\n";

echo "## Contact\n\n";
echo "- Address: A-1110, RK Iconic, Near Sheetal Park, 150 Feet Ring Rd, Rajkot, Gujarat 360006, India\n";
echo "- Phone: +91 63555 59016\n";
echo "- Email: info@codeksha.com\n";
