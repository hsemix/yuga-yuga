---
description: 'A php framework for people with mvvm background knowledge,'
---

# Yuga Framework

To get started you just need one command `composer create-project yuga/yuga your-project-folder`

Yuga has two programming paradigms it uses i.e mvvm and mvc, the developer gets to decide which paradigm they want to use but by default the framework comes set with mvvm structure.  
If you want to change this setting, you go to `environment/.env` file and locate the paradigm key, change it to mvc and you are done.

**Local Development Server**

If you have PHP installed locally and you would like to use PHP's built-in development server to launch your application, you may use the `start` Yuga command. This command will start a development server at `http://localhost:8000`:

```bash
php yuga start
```

