---
description: Schedulers
---

# Schedulers

This makes scheduling cronjobs in your application simple, flexible, and powerful. Instead of setting up multiple cronjobs on each server your application runs on, you only need to set up a single cronjob to point to the script, and then all of your tasks are scheduled in your code. Besides that, it provides CLI tools to help you manage the tasks that should be run.

Instead of what used to be done in the past of generating a Cron entry for each task you needed to schedule on your server. This is hard to manage since your task schedule is no longer in source control and you must SSH into your server to add additional Cron entries.
