🌐 Language: [🇧🇷 PT-BR](README_pt-BR.md) | **🇺🇸 EN**

SmartEdu (block_smartedu) 
====================

A Moodle LMS block plugin that leverages the potential of AI to enhance education.

## 📘 Documentation in Portuguese (PT-BR)

To access the Portuguese version of this documentation, click below:

[➡️ Read the README in Portuguese](README_pt-BR.md)

## ✨ Current Features

- Summarizes lecture notes provided by the teacher in various [file formats](file-formats.md). Users can hide items from the plugin by using tag `smartedu-hide` in the resource settings.

- Summarizes forum discussions.

- Generates simple or detailed summaries, based on user preference.

- Generate quizzes, study guides and mind maps from lecture notes.

- Currently, the plugin supports the following generative AI providers: Google (Gemini), OpenAI (ChatGPT) and Local (Ollama). 


## 📦 Requirements

Moodle 3.9 or greater.

## 🚀 Installation

Simply install the plugin and add the block to a course page. 

## ⚙️ Administrator Settings

After installing the plugin, administrators can configure the integration with generative AI providers.  
Navigate to: `Site administration > Plugins > Blocks > SmartEdu`


You will see the following configuration page:

![Administrator Settings](docs/images/admin-settings.png)

The available settings are:

- **Choose your AI provider**  
  Select the provider to be used by the plugin. Currently supported options are **Google (Gemini)**, **OpenAI (ChatGPT)**, and **Local (Ollama)**.  
  *Default:* Google (Gemini)

- **Enter the API key for your AI provider**  
  Insert the API key obtained from the chosen provider. Depending on the provider, you may need to create an account and purchase a plan to obtain a valid API key (e.g., Google Gemini or OpenAI).  
  *Default:* Empty

- **Enter the model for your AI provider**  
  Define the specific model you want to use (e.g., `gemini-2.0-flash`, `gpt-4o-mini`, `gemma3:4b`).  
  *Default:* Empty

- **Enter the API URL for your AI provider (local)**  
  Required only when using local AI providers such as Ollama. Example:  
  `http://localhost:11434/api/chat`  
  *Default:* Empty

- **Enable prompt cache**  
  When enabled, the plugin caches previous prompts to improve performance and

## 📚 Using the Plugin

Teachers can add the **SmartEdu** block to any course they are responsible for.  
Once added, the block will appear on the **right-hand side of the course page**, as shown below:

![SmartEdu Block Example](docs/images/block-example.png)

In this example, the block displays two course resources:

- **Information Security – Part 1 (PDF)**  
  A lecture note file uploaded by the teacher. SmartEdu can summarize this document and generate additional study materials (summaries, study guides, quizzes, or mind maps).

- **Discussion about Privacy (Forum)**  
  A discussion forum created within the course. SmartEdu can automatically summarize forum discussions, helping students quickly capture the key points.

At the bottom of the block, a message reminds users that by using the SmartEdu block, they agree to its [terms of use](terms-of-use.md). This ensures transparency about how the plugin interacts with generative AI services and handles educational content.

------------

### Example: Automatic Summaries and Study Guides

When a teacher uploads lecture notes, SmartEdu can automatically generate **summaries** and **study guides** to support student learning.  

The example below shows content generated from the resource *Information Security – Part 1*:

![Generated Summary and Study Guide](docs/images/generated-study-guide.png)

- The **summary** condenses the main ideas of the lecture notes into a clear and concise format.  
- The **study guide** highlights:
  - **Main Theme** of the lesson;
  - **Objectives** to guide student learning;
  - **Subjects to Learn**, organized with key definitions, concepts, and categories, etc.

These resources help students focus on the most important aspects of the material and prepare more effectively for discussions, quizzes, and exams.

------------

### Example: Automatic Mind Maps

In addition to summaries and study guides, SmartEdu can also generate **interactive mind maps** from lecture notes.  

These mind maps provide a **visual representation** of the key concepts, helping students to quickly grasp relationships between ideas and navigate through complex topics.

The example below was generated from the same resource *Information Security – Part 1*:

![Generated Mind Map](docs/images/generated-mindmap.png)

- The **central node** represents the main theme of the lecture (*Basics of Information Security*).  
- **Branches** expand into related concepts, such as types of security attacks, services, and mechanisms.  
- Students can explore the map interactively, zooming in and out, and expanding/collapsing branches to focus on specific details.  

Mind maps are especially useful for learners who benefit from **visual study aids** and for reviewing material in a more engaging and memorable way.

------------

### Example: Interactive Quizzes

Another key feature of SmartEdu is the ability to generate **interactive quizzes** directly from lecture notes.  

These quizzes allow students to **practice their knowledge** by answering multiple-choice questions. At the end, they can submit their answers and immediately receive feedback.

The example below shows a quiz generated from the lecture *Information Security – Part 1*:

![Generated Quiz](docs/images/generated-quiz.png)

- Each question presents **four alternatives (A, B, C, D)**.  
- After selecting an answer, students receive **instant feedback**:  
  - Whether the answer is correct or incorrect.  
  - A short explanation clarifying why the chosen option is right or wrong.  

This interactive approach helps students:  
- Reinforce what they learned in class.  
- Identify misconceptions or knowledge gaps.  
- Learn from their mistakes by reading the feedback provided for each option.

------------

### Example: Forum Summaries

SmartEdu can also process **forum discussions** and automatically generate concise summaries of the main points raised by participants.  

This is especially useful in courses with active discussions, where it may be difficult for students and teachers to keep track of every message.

The example below shows a summary generated from a forum on *Discussion about Privacy*:

![Generated Forum Summary](docs/images/generated-forum-summary.png)

By condensing long threads into clear takeaways, SmartEdu helps students focus on the **most relevant insights** from the discussion, while allowing teachers to quickly gauge the overall direction of the debate.

## 🧑‍🏫 Teacher Settings

In addition to the administrator settings, each teacher can customize how the **SmartEdu block** behaves in their course.  
To do this, they can open the block’s configuration panel, as shown below:

![Teacher Settings](docs/images/teacher-settings.png)

The available options include:

- **Summary type**  
  Defines how summaries will be generated. Teachers can choose between:
  - *Simple*: Produces a short, concise summary.  
  - *Detailed*: Produces a longer, more comprehensive summary.  

- **Number of questions**  
  Sets the number of quiz questions to be generated from the selected resource.  
  Teachers can also set this value to **0**, meaning that **no quiz will be generated**.  

- **Generate study guide**  
  When enabled, SmartEdu creates a structured **study guide** alongside the summary.  
  
- **Generate mind map**  
  When enabled, SmartEdu generates an **interactive mind map** from the resource.  
  
------------

### Hidden Resources

If a teacher marks a resource as **hidden from students** in Moodle, SmartEdu respects this configuration.  
In this case:  

- The resource will **not appear** for students in the SmartEdu block.  
- The teacher will still see the resource listed, with the suffix **“– hidden from students”**, indicating that it is invisible to learners.  

![Hidden Resource Example](docs/images/hidden-resource.png)

This ensures consistency with Moodle’s visibility rules while still giving teachers full awareness of which resources are available (or not) to students.

------------

### Excluding Resources from the Plugin

In some cases, a teacher may add resources to the course that are **not intended for SmartEdu processing**.  
Examples include:  
- A description of a practical assignment.  
- A course syllabus or plan.  
- Any document that does not contain actual teaching content.  

By default, if a resource is in a supported file format, SmartEdu will attempt to process it and make it available to students. To prevent this, we provide a **special tag** called: `smartedu-hide`

When this tag is applied to a resource, the plugin will **ignore it entirely**, meaning it will not appear in the SmartEdu block for students.

![Hide Resource Tag](docs/images/smartedu-hide-tag.png)

This gives teachers greater control over which resources are included in SmartEdu’s summaries, study guides, quizzes, and mind maps.

## 📌 Considerations

### What type of generative AI does the SmartEdu plugin use?

Currently, the plugin only supports Gemini, ChatGPT and Local (Ollama). 

**Note:** The plugin has been best tested with Google Gemini. For local AI providers (Ollama), it works best with instruct-type models, which are optimized for following instructions and generating educational content.

### What aspects should be considered when using the plugin?

These and other questions are covered in the plugin's [terms of use](terms-of-use.md).

## 📜 License

Licensed under the [GNU GPL License](LICENSE).
