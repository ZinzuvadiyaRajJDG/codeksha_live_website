<?php @include __DIR__ . '/../inc/tracker.php'; /* analytics */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>What Is n8n? A Beginner&#x27;s Guide to Workflow Automation</title>
    <meta name="description" content="What n8n is, how workflows, nodes and triggers work, what it costs, how to self-host it, and how to build your first automation and AI agent." />
    <meta name="robots" content="index, follow, max-image-preview:large" />
    <link rel="canonical" href="https://codeksha.com/blog/what-is-n8n/" />

    <meta property="og:type" content="article" />
    <meta property="og:site_name" content="Codeksha" />
    <meta property="og:title" content="What Is n8n? A Beginner&#x27;s Guide to Workflow Automation" />
    <meta property="og:description" content="What n8n is, how workflows, nodes and triggers work, what it costs, how to self-host it, and how to build your first automation and AI agent." />
    <meta property="og:url" content="https://codeksha.com/blog/what-is-n8n/" />
    <meta property="og:image" content="https://codeksha.com/Images/blog/live/what-is-n8n.webp" />
    <meta property="og:locale" content="en_IN" />
    <meta property="article:published_time" content="2026-10-29" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="What Is n8n? A Beginner&#x27;s Guide to Workflow Automation" />
    <meta name="twitter:description" content="What n8n is, how workflows, nodes and triggers work, what it costs, how to self-host it, and how to build your first automation and AI agent." />
    <meta name="twitter:image" content="https://codeksha.com/Images/blog/live/what-is-n8n.webp" />

    <?php require __DIR__ . '/../inc/partials/head.php'; ?>
    <link rel="stylesheet" href="/assets/blog-extras.css?v=2" />

    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "https://codeksha.com/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "https://codeksha.com/blog/"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "What Is n8n",
      "item": "https://codeksha.com/blog/what-is-n8n/"
    }
  ]
}
    </script>
    <script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "headline": "What Is n8n? A Beginner's Guide to Workflow Automation",
  "description": "What n8n is, how workflows, nodes and triggers work, what it costs, how to self-host it, and how to build your first automation and AI agent.",
  "image": "https://codeksha.com/Images/blog/live/what-is-n8n.webp",
  "datePublished": "2026-10-29",
  "dateModified": "2026-10-29",
  "author": {
    "@type": "Organization",
    "name": "Codeksha",
    "url": "https://codeksha.com/"
  },
  "publisher": {
    "@type": "Organization",
    "name": "Codeksha",
    "logo": {
      "@type": "ImageObject",
      "url": "https://codeksha.com/Images/Codeksha-Logo.png"
    }
  },
  "mainEntityOfPage": "https://codeksha.com/blog/what-is-n8n/",
  "inLanguage": "en-IN",
  "keywords": "what is n8n, what is n8n used for, n8n workflow automation, n8n ai agent, n8n tutorial for beginners"
}
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        { "@type": "Question", "name": "What does n8n stand for?", "acceptedAnswer": { "@type": "Answer", "text": "n8n is short for nodemation, a blend of node, Node.js and automation. The 8 stands for the eight letters between the first and last n." } },
        { "@type": "Question", "name": "Is n8n free?", "acceptedAnswer": { "@type": "Answer", "text": "The Community Edition can be self-hosted for free, though you pay for the server you run it on. The managed cloud plans are paid and priced by the number of workflow executions per month." } },
        { "@type": "Question", "name": "Is n8n open source?", "acceptedAnswer": { "@type": "Answer", "text": "It is source-available under n8n's own fair-code Sustainable Use License rather than an Open Source Initiative licence. You can view, self-host and modify the code, but you cannot sell it as a competing hosted service." } },
        { "@type": "Question", "name": "Do I need to know coding to use n8n?", "acceptedAnswer": { "@type": "Answer", "text": "No, you can build many workflows by connecting nodes. Basic JavaScript and a good grasp of APIs and JSON help a lot for more advanced automations." } },
        { "@type": "Question", "name": "Is n8n better than Zapier?", "acceptedAnswer": { "@type": "Answer", "text": "It depends. Zapier is simpler to start with. n8n offers more control, self-hosting and strong AI agent features, which makes it a better long-term skill for developers and freelancers." } },
        { "@type": "Question", "name": "Can n8n build AI agents?", "acceptedAnswer": { "@type": "Answer", "text": "Yes. n8n has an AI Agent node and AI nodes built around LangChain, so you can connect a language model to tools, memory and your own data and combine it with normal workflow steps." } },
        { "@type": "Question", "name": "How long does it take to learn n8n?", "acceptedAnswer": { "@type": "Answer", "text": "Most people build useful workflows within a week or two. Becoming comfortable with APIs, error handling and AI agents typically takes about a month of regular practice." } }
      ]
    }
    </script>
  </head>
  <body>
    <div class="top-banner">
      <p>Brand new Course Package released! Get 10% off your first purchase with code “CK-10OFF”. <a href="#">Find out more!</a></p>
    </div>

    <?php $ck_active = 'blog'; require __DIR__ . '/../inc/partials/nav.php'; ?>

    <!-- POST HERO -->
    <section class="post-hero">
      <div class="container">
        <p class="breadcrumb"><a href="/">Home</a> / <a href="/blog/">Blog</a> / Web Development</p>
        <span class="post-cat">Web Development</span>
        <h1>What Is n8n? A Beginner's Guide to Workflow Automation</h1>
        <div class="post-meta">
          <span><i class="fa-regular fa-calendar"></i> October 29, 2026</span>
          <span><i class="fa-regular fa-clock"></i> 11 min read</span>
          <span><i class="fa-solid fa-building"></i> Codeksha Team</span>
        </div>
      </div>
    </section>

    <!-- POST BODY -->
    <section class="post-body-section">
      <div class="container">
        <div class="post-layout">
          <div class="post-body">
            <div class="post-feature-img"><img src="/Images/blog/live/what-is-n8n.webp" alt="What is n8n: a beginner guide to workflow automation with nodes and triggers" width="1200" height="630" fetchpriority="high"></div>

            <details class="post-toc-mobile">
              <summary>In this guide</summary>
              <ul><li><a href="#what-is-n8n">What is n8n?</a></li><li><a href="#how-it-works">How it works</a></li><li><a href="#what-is-it-used-for">What it is used for</a></li><li><a href="#ai-agents">n8n and AI agents</a></li><li><a href="#pricing">Pricing</a></li><li><a href="#get-started">How to get started</a></li><li><a href="#first-workflow">Your first workflow</a></li><li><a href="#n8n-vs-others">n8n vs Zapier and Make</a></li><li><a href="#learn-n8n">Learning path</a></li><li><a href="#faq">FAQs</a></li></ul>
            </details>

<p>If you spend any time around developers, marketers or freelancers in 2026, you will hear "just automate it in n8n". It is one of the fastest-growing tools in the automation and AI space, yet most beginner explanations either stay vague or jump straight into server setup. This guide explains <strong>what n8n is, how it works, what it costs, what you can build with it and how to start</strong>, in plain language.</p>

<div class="post-takeaways">
  <p class="post-takeaways-title"><i class="fa-solid fa-bolt"></i> The quick answer</p>
  <ul class="learn-checklist">
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>What it is:</strong> a visual <a href="https://www.techvantara.com/" target="_blank" rel="noopener">workflow automation</a> platform where you connect apps and AI models with drag-and-drop nodes.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>What makes it different:</strong> you can self-host it, add your own JavaScript or Python, and build AI agents in the same editor.</span></li>
    <li><i class="fa-solid fa-circle-check"></i> <span><strong>Who it suits:</strong> developers, marketers, operations teams, freelancers and students who want an in-demand automation skill.</span></li>
  </ul>
</div>

<h2 id="what-is-n8n">What Is n8n?</h2>
<p>n8n (pronounced "n-eight-n") is a workflow automation tool. You build an <strong>automation</strong> by placing steps on a canvas and connecting them: when something happens in one app (a form is submitted, an email arrives, a payment is made), n8n does a series of actions in other apps (save a row, send a message, create a task, ask an AI to write a reply) without you doing it by hand.</p>
<p>The name is short for <em>nodemation</em>: a mix of "node" (the building block of every workflow), Node.js (what it is built on) and "automation". It was created by Jan Oberhauser and is developed by n8n GmbH in Berlin; the project launched publicly in 2019, according to its <a href="https://en.wikipedia.org/wiki/N8n" target="_blank" rel="noopener">Wikipedia entry</a>.</p>
<p>Three things set it apart from simpler tools:</p>
<ul>
  <li><strong>You can self-host it.</strong> Run it on your own computer or server instead of paying per task on someone else's cloud.</li>
  <li><strong>It is code-friendly.</strong> Where a ready-made node is not enough, a Code node lets you write JavaScript (or Python) in the middle of a workflow.</li>
  <li><strong>It is built for AI.</strong> It has AI agent nodes that let a language model decide which tools to use, so you can build assistants and automations that "think" a step.</li>
</ul>

<h2 id="how-it-works">How n8n Works: The Five Building Blocks</h2>
<div class="table-wrap"><table class="post-table">
<thead><tr><th>Term</th><th>What it means</th></tr></thead>
<tbody>
<tr><td><strong>Workflow</strong></td><td>A set of connected nodes that automates one process, from start to finish.</td></tr>
<tr><td><strong>Trigger node</strong></td><td>The first node. It starts the workflow when an event happens: a form submission, a webhook call, a schedule, a new email.</td></tr>
<tr><td><strong>Node</strong></td><td>One step. It fetches data, changes it, or sends it somewhere. There are built-in nodes for hundreds of apps, community nodes, and you can build your own.</td></tr>
<tr><td><strong>Execution</strong></td><td>One run of a workflow. n8n records each execution so you can see what data went through every node and why something failed.</td></tr>
<tr><td><strong>Credentials</strong></td><td>The saved logins or API keys that let a node access your apps. They are stored once and reused.</td></tr>
</tbody></table></div>
<p>Here is a simple workflow: a student fills a form, the answer is saved, and the team is notified.</p>
<div class="flow-row"><div class="flow-node trigger">Form submitted<small>Trigger</small></div><span class="flow-arrow">&rarr;</span><div class="flow-node">Google Sheets<small>Add a row</small></div><span class="flow-arrow">&rarr;</span><div class="flow-node">AI model<small>Write a reply</small></div><span class="flow-arrow">&rarr;</span><div class="flow-node">Gmail / Telegram<small>Notify the team</small></div></div>
<p>Data flows left to right. Each node receives the output of the previous one, so the AI step can use the name and question from the form, and the final step can include the AI reply in the message.</p>

<h2 id="what-is-it-used-for">What Is n8n Used For? Real Examples</h2>
<ol class="post-steps">
  <li><strong>Lead capture.</strong> When someone fills a website form, add them to a spreadsheet or CRM and send a WhatsApp, Telegram or email alert to your sales team.</li>
  <li><strong>Social media and content.</strong> Collect ideas in a sheet, have an AI draft captions, and schedule or post them for review.</li>
  <li><strong>Reports.</strong> Pull numbers from several tools every Monday and email a summary to your team.</li>
  <li><strong>AI assistants.</strong> Build a support or FAQ bot that reads your documents and answers questions, with a human fallback.</li>
  <li><strong>Data syncing.</strong> Keep two systems in step: a new order in a store creates an invoice, a row in a database, and a message in a chat channel.</li>
  <li><strong>Internal ops.</strong> Onboard a new employee by creating accounts, sending a welcome email and adding calendar events from one trigger.</li>
</ol>
<p>This is also why n8n is a useful freelance and job skill: small businesses pay for exactly these automations. See how automation fits into the wider picture in our post on the <a href="/blog/importance-of-digital-marketing/">importance of digital marketing</a>.</p>

<h2 id="ai-agents">n8n and AI Agents</h2>
<p>Classic automation follows fixed rules: if A, then B. An <strong>AI agent</strong> workflow adds a language model that can decide what to do next. In n8n you connect an AI Agent node to a chat model, give it tools (search the web, query a database, send an email) and optional memory, and it chooses which tool to use for each request. n8n integrates with LangChain through dedicated AI nodes, and newer versions can even draft a workflow from a plain-language prompt.</p>
<p>A useful rule: use a normal workflow when the steps are fixed, and add an agent only for the parts that need judgement, such as classifying an email or writing a reply. It is faster, cheaper and easier to debug that way.</p>
<p>If you want to get better at instructing models, our <a href="/course/prompt-engineering/">Prompt Engineering course</a> is a natural companion to n8n.</p>

<h2 id="pricing">n8n Pricing: Free Self-Hosting vs Cloud</h2>
<p>There are two ways to run n8n: let n8n host it for you (cloud) or host it yourself. n8n charges by <strong>workflow executions per month</strong>, not by the number of steps or users. According to the <a href="https://n8n.io/pricing/" target="_blank" rel="noopener">official pricing page</a> (annual billing, in euros, when we checked in October 2026):</p>
<div class="table-wrap"><table class="post-table">
<thead><tr><th>Plan</th><th>Price</th><th>Executions / month</th><th>Hosting</th></tr></thead>
<tbody>
<tr><td><strong>Starter</strong></td><td>€20 per month</td><td>2,500</td><td>Hosted by n8n</td></tr>
<tr><td><strong>Pro</strong></td><td>€50 per month</td><td>10,000</td><td>Hosted by n8n</td></tr>
<tr><td><strong>Business</strong></td><td>€667 per month</td><td>40,000</td><td>Self-hosted</td></tr>
<tr><td><strong>Enterprise</strong></td><td>Contact sales</td><td>Custom</td><td>Hosted or self-hosted</td></tr>
</tbody></table></div>
<p>All plans include unlimited users and workflows. There is also a free <strong>Community Edition</strong> that you can self-host from GitHub. Prices and limits change, so confirm them on the pricing page before you decide.</p>
<div class="post-callout"><strong>Is n8n open source?</strong> Not in the strict sense. n8n calls its model "fair-code": the source code is public, and you can self-host and modify it, but you cannot resell it as a competing hosted service. It uses its own Sustainable Use License, so "source-available" is the more accurate description. For learning and running your own automations this makes no practical difference.</div>

<h2 id="get-started">How to Get Started With n8n</h2>
<h3>Option 1: n8n Cloud (easiest)</h3>
<p>Sign up on <a href="https://n8n.io/" target="_blank" rel="noopener">n8n.io</a> and start building in the browser, with nothing to install. This is the fastest way to learn the editor.</p>
<h3>Option 2: Run it on your computer with Node.js</h3>
<p>If you have Node.js installed, you can try n8n with a single command and open it in your browser:</p>
<pre><code>npx n8n
<span class="c"># then open http://localhost:5678</span></code></pre>
<h3>Option 3: Run it with Docker</h3>
<p>This is the setup the n8n docs describe for self-hosting. It keeps your data in a Docker volume so it survives restarts:</p>
<pre><code>docker volume create n8n_data

docker run -it --rm --name n8n -p 5678:5678 \
  -v n8n_data:/home/node/.n8n \
  n8nio/n8n
<span class="c"># then open http://localhost:5678</span></code></pre>
<p>For anything beyond learning, the n8n documentation recommends the Docker Compose method with a proper database, HTTPS and backups, so read the <a href="https://docs.n8n.io/hosting/" target="_blank" rel="noopener">hosting guide</a> before running it for a real business.</p>

<h2 id="first-workflow">Build Your First Workflow in 10 Minutes</h2>
<ol class="post-steps">
  <li><strong>Create a new workflow</strong> and add a <em>Form Trigger</em> node with two fields: name and question.</li>
  <li><strong>Add a Google Sheets node</strong> to append each submission as a row. Connect your Google account once under credentials.</li>
  <li><strong>Add an AI node</strong> (an OpenAI, Gemini or other chat model node) and write a prompt such as "Write a short, friendly reply to this question". Use the form fields in the prompt.</li>
  <li><strong>Add a Gmail or Telegram node</strong> to send the AI reply to yourself first, so you can check the quality.</li>
  <li><strong>Click Execute workflow</strong>, submit the form, and watch the data move through each node. Open any node to see exactly what went in and out.</li>
  <li><strong>Activate the workflow</strong> when you are happy, so it runs on its own.</li>
</ol>
<p>Debugging by inspecting each node's data is where most of the learning happens, so do not skip step 5.</p>

<h2 id="n8n-vs-others">n8n vs Zapier vs Make</h2>
<p>All three connect apps without code. In short: Zapier is the easiest to start with, Make sits in the middle with a visual canvas, and n8n gives the most control and the option to self-host, with a slightly steeper start. We compare them in detail, with a recommendation for learners, in <a href="/blog/n8n-vs-zapier/">n8n vs Zapier: which should you learn?</a></p>

<h2 id="learn-n8n">Should You Learn n8n? A Practical Learning Path</h2>
<ul class="learn-checklist">
  <li><i class="fa-solid fa-circle-check"></i> <span><strong>Week 1:</strong> triggers, nodes and the data model (items and JSON). Build three small workflows.</span></li>
  <li><i class="fa-solid fa-circle-check"></i> <span><strong>Week 2:</strong> webhooks, HTTP Request node, working with APIs and credentials. Connect two real apps.</span></li>
  <li><i class="fa-solid fa-circle-check"></i> <span><strong>Week 3:</strong> logic (IF, Switch, Merge, loops), error handling and the Code node for JavaScript.</span></li>
  <li><i class="fa-solid fa-circle-check"></i> <span><strong>Week 4:</strong> AI nodes and an agent with tools and memory, then deploy and monitor a workflow.</span></li>
</ul>
<p>Basic JavaScript and understanding of APIs make everything faster, so a developer background helps, but plenty of non-developers learn n8n successfully. If you are early in your coding journey, our <a href="/blog/javascript-roadmap-for-beginners-what-to-learn-step-by-step/">JavaScript roadmap</a> and the <a href="/blog/full-stack-developer-roadmap/">full stack developer roadmap</a> are good starting points.</p>
<div class="post-callout">At Codeksha in Rajkot, our <a href="/course/n8n-automation/">n8n Automation course</a> teaches workflows, APIs and AI agents with live, hands-on projects, as part of the wider <a href="/course/ai-automation/">AI &amp; Automation</a> track. You can try a class first with a <a href="/book-demo/#course=ai-automation">free demo</a>.</div>
<div class="post-lead-inline">
<?php $lf_course = 'AI & Automation'; $lf_id = 'lfn8nmid'; $lf_title = 'Learn n8n With Real Projects'; $lf_sub = 'Leave your number and a Codeksha counsellor will call you back about the n8n Automation course and a free demo class.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
</div>
<h2 id="faq">Frequently Asked Questions</h2>
<h3>What does n8n stand for?</h3>
<p>n8n is short for "nodemation", a blend of node, Node.js and automation. The "8" stands for the eight letters between the first and last "n".</p>
<h3>Is n8n free?</h3>
<p>The Community Edition can be self-hosted for free, though you pay for the server you run it on. The managed cloud plans are paid and priced by the number of workflow executions per month.</p>
<h3>Is n8n open source?</h3>
<p>It is source-available under n8n's own "fair-code" Sustainable Use License rather than an Open Source Initiative licence. You can view, self-host and modify the code, but you cannot sell it as a competing hosted service.</p>
<h3>Do I need to know coding to use n8n?</h3>
<p>No, you can build many workflows by connecting nodes. Basic JavaScript and a good grasp of APIs and JSON help a lot once you move to more advanced automations.</p>
<h3>Is n8n better than Zapier?</h3>
<p>It depends. Zapier is simpler to start with. n8n offers more control, self-hosting and strong AI agent features, which makes it a better long-term skill for developers and freelancers. See the full <a href="/blog/n8n-vs-zapier/">n8n vs Zapier comparison</a>.</p>
<h3>Can n8n build AI agents?</h3>
<p>Yes. n8n has an AI Agent node and AI nodes built around LangChain, so you can connect a language model to tools, memory and your own data, and combine it with normal workflow steps.</p>
<h3>How long does it take to learn n8n?</h3>
<p>Most people build useful workflows within a week or two. Becoming comfortable with APIs, error handling and AI agents typically takes about a month of regular practice.</p>

            <div class="post-cta-box">
              <h3>Want to Learn n8n Properly, With Real Projects?</h3>
              <p>Codeksha's <a href="/course/n8n-automation/">n8n Automation course</a> in Rajkot teaches you to build real workflows and AI agents, live and hands-on. Book a free demo class and see a session for yourself.</p>
              <a href="/book-demo/#course=ai-automation" class="hero-enroll-btn">
                <span>Book a Free Demo Class</span>
                <div class="arrow-btn-circle"><i data-lucide="arrow-right"></i></div>
              </a>
            </div>

            <div class="post-lead-inline" id="get-in-touch">
              <?php $lf_course = 'AI & Automation'; $lf_id = 'lfn8nend'; $lf_title = 'Get Syllabus, Fees &amp; a Free Demo'; $lf_sub = 'Tell us your number and a Codeksha counsellor will call you back about the n8n Automation course in Rajkot.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
            </div>

            <div class="post-tags">
            <span class="post-tag">n8n</span>
            <span class="post-tag">Automation</span>
            <span class="post-tag">AI Agents</span>
            <span class="post-tag">AI & Automation</span>
            </div>
            <div class="post-share-row">
              <span>Share:</span>
              <a href="https://www.linkedin.com/company/codeksha/" target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
              <a href="https://x.com/TeamCodeksha" target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"><i class="fa-brands fa-x-twitter"></i></a>
              <a href="https://www.instagram.com/codeksha_official" target="_blank" rel="noopener noreferrer" aria-label="Share on Instagram"><i class="fa-brands fa-instagram"></i></a>
            </div>
          </div>

          <aside class="post-sidebar has-lead">
            <div class="sidebar-card sidebar-toc">
              <h4><i class="fa-solid fa-list-ul"></i> Table of Contents</h4>
              <ul class="toc-list">
                <li><a href="#what-is-n8n">What is n8n?</a></li>
                <li><a href="#how-it-works">How it works</a></li>
                <li><a href="#what-is-it-used-for">What it is used for</a></li>
                <li><a href="#ai-agents">n8n and AI agents</a></li>
                <li><a href="#pricing">Pricing</a></li>
                <li><a href="#get-started">How to get started</a></li>
                <li><a href="#first-workflow">Your first workflow</a></li>
                <li><a href="#n8n-vs-others">n8n vs Zapier and Make</a></li>
                <li><a href="#learn-n8n">Learning path</a></li>
                <li><a href="#faq">FAQs</a></li>
                </ul>
            </div>
            <div class="sidebar-lead">
              <?php $lf_course = 'AI & Automation'; $lf_id = 'lfn8nside'; $lf_title = 'Learn n8n With Real Projects'; $lf_sub = 'Leave your number and our counsellor will call you back. No spam, no pressure.'; require __DIR__ . '/../inc/partials/lead-form.php'; ?>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- RELATED POSTS -->
    <section class="blog-section" style="background:#f8fafc; padding-top:0;">
      <div class="container">
        <div class="section-header">
          <span class="sub-title">KEEP READING</span>
          <h2>Related <span>Articles</span></h2>
        </div>
        <div class="blog-grid">
          <a href="/blog/n8n-vs-zapier/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/n8n-vs-zapier.webp" alt="n8n vs Zapier: Which Automation Tool Should You Learn?" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>n8n vs Zapier: Which Automation Tool Should You Learn?</h3>
              <p>n8n vs Zapier compared for people deciding what to learn: pricing, learning curve, AI features and which one fits your goals.</p>
              <div class="blog-card-meta"><span>8 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
          <a href="/blog/full-stack-developer-roadmap/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/full-stack-developer-roadmap.webp" alt="Full Stack Developer Roadmap 2026-27: Skills, Tools, Salary and How to Start" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Career</span>
              <h3>Full Stack Developer Roadmap 2026-27: Skills, Tools, Salary and How to Start</h3>
              <p>A phase-by-phase full stack developer roadmap: what to learn, in what order, how long it takes, the projects to build and what freshers earn.</p>
              <div class="blog-card-meta"><span>15 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
          <a href="/blog/javascript-roadmap-for-beginners-what-to-learn-step-by-step/" class="blog-card" style="text-decoration:none;">
            <div class="blog-card-img"><img src="/Images/blog/live/the-power-of-javascript-why-every-developer-needs-it.webp" alt="JavaScript Roadmap for Beginners: What to Learn Step by Step" loading="lazy" width="1200" height="630"></div>
            <div class="blog-card-body">
              <span class="blog-card-cat">Web Development</span>
              <h3>JavaScript Roadmap for Beginners: What to Learn Step by Step</h3>
              <p>A practical JavaScript roadmap for beginners: what to learn first, in what order, and which mistakes to avoid.</p>
              <div class="blog-card-meta"><span>9 min read</span><span>Read more &rarr;</span></div>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <?php require __DIR__ . '/../inc/partials/site-footer.php'; ?>

    <script>
      document.addEventListener('DOMContentLoaded', () => {
        if (window.lucide) lucide.createIcons();
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const navLinks = document.getElementById('navLinks');
        const navOverlay = document.getElementById('navOverlay');
        if (hamburgerBtn && navLinks) {
          const toggleMenu = () => {
            const isActive = navLinks.classList.toggle('active');
            if (navOverlay) navOverlay.classList.toggle('active', isActive);
            const icon = hamburgerBtn.querySelector('i');
            if (icon) icon.className = isActive ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
          };
          hamburgerBtn.addEventListener('click', toggleMenu);
          if (navOverlay) navOverlay.addEventListener('click', toggleMenu);
          navLinks.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
            if (navLinks.classList.contains('active')) toggleMenu();
          }));
        }

        // Expand / collapse all questions
        document.querySelectorAll('[data-qa-toggle]').forEach(btn => {
          btn.addEventListener('click', () => {
            const open = btn.getAttribute('data-qa-toggle') === 'open';
            document.querySelectorAll('details.qa').forEach(d => { d.open = open; });
          });
        });
        // Open a question when it is linked to directly (#q12)
        if (location.hash && /^#q\d+$/.test(location.hash)) {
          const t = document.querySelector(location.hash);
          if (t && t.tagName === 'DETAILS') { t.open = true; t.scrollIntoView(); }
        }

        // Table of contents scroll-spy
        const tocLinks = document.querySelectorAll('.toc-list a');
        const tocTargets = Array.from(tocLinks).map(a => document.getElementById(a.getAttribute('href').slice(1))).filter(Boolean);
        if (tocTargets.length && 'IntersectionObserver' in window) {
          const spy = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
              const link = document.querySelector('.toc-list a[href="#' + entry.target.id + '"]');
              if (!link) return;
              if (entry.isIntersecting) {
                tocLinks.forEach(l => l.classList.remove('active'));
                link.classList.add('active');
              }
            });
          }, { rootMargin: '-15% 0px -70% 0px' });
          tocTargets.forEach(t => spy.observe(t));
        }
      });
    </script>
  </body>
</html>
