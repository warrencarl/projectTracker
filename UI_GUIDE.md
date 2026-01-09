# User Interface Guide - Visual Walkthrough

## Page-by-Page Visual Description

This document describes what each page looks like and how users interact with it.

---

## 1. Login Page (`views/login.php`)

**URL**: `http://localhost/projectTracker/` or `index.php?action=login`

### Visual Layout
```
┌─────────────────────────────────────────────────────┐
│                                                     │
│              [Purple Gradient Background]           │
│                                                     │
│   ┌───────────────────────────────────────────┐   │
│   │                                           │   │
│   │          Project Tracker                  │   │
│   │               Login                       │   │
│   │                                           │   │
│   │   [Email field]                          │   │
│   │   [Password field]                       │   │
│   │                                           │   │
│   │          [Login Button]                   │   │
│   │                                           │   │
│   │   Don't have an account? Register here   │   │
│   │                                           │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Elements
- **Title**: "Project Tracker" (purple, centered)
- **Subtitle**: "Login" (gray, centered)
- **Email Input**: Text field with label "Email:"
- **Password Input**: Password field with label "Password:"
- **Login Button**: Purple gradient button, full-width
- **Register Link**: Text link at bottom
- **Error Messages**: Red alert box (if login fails)

### User Actions
1. Enter email address
2. Enter password
3. Click "Login" button
4. Or click "Register here" to create account

### Error States
- "Please fill in all fields" - if fields are empty
- "Invalid email or password" - if credentials are wrong

---

## 2. Registration Page (`views/register.php`)

**URL**: `index.php?action=register`

### Visual Layout
```
┌─────────────────────────────────────────────────────┐
│                                                     │
│              [Purple Gradient Background]           │
│                                                     │
│   ┌───────────────────────────────────────────┐   │
│   │                                           │   │
│   │          Project Tracker                  │   │
│   │              Register                     │   │
│   │                                           │   │
│   │   Oracle ID: *  [Input field]            │   │
│   │   Username: *   [Input field]            │   │
│   │   Email: *      [Input field]            │   │
│   │   Password: *   [Input field]            │   │
│   │   Confirm: *    [Input field]            │   │
│   │   Role: *       [Dropdown: Agent/Supervisor] │
│   │                                           │   │
│   │          [Register Button]                │   │
│   │                                           │   │
│   │   Already have an account? Login here    │   │
│   │                                           │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Elements
- **Title**: "Project Tracker" (purple, centered)
- **Subtitle**: "Register" (gray, centered)
- **Oracle ID Input**: Text field with red asterisk (required)
  - Placeholder: "Enter your unique Oracle ID"
- **Username Input**: Text field with red asterisk (required)
- **Email Input**: Email field with red asterisk (required)
- **Password Input**: Password field with red asterisk (required)
  - Placeholder: "Minimum 6 characters"
- **Confirm Password**: Password field with red asterisk (required)
- **Role Dropdown**: Select with options:
  - "Select a role" (default)
  - "Agent"
  - "Supervisor"
- **Register Button**: Purple gradient button, full-width
- **Login Link**: Text link at bottom
- **Error Messages**: Red alert box (if validation fails)
- **Success Messages**: Green alert box (if registration succeeds)

### User Actions
1. Enter Oracle ID (unique identifier)
2. Enter username
3. Enter email address
4. Enter password (min 6 characters)
5. Confirm password
6. Select role (Agent or Supervisor)
7. Click "Register" button
8. Or click "Login here" if already have account

### Validation Rules
- All fields required
- Email must be valid format
- Password minimum 6 characters
- Passwords must match
- Oracle ID must be unique
- Email must be unique
- Role must be selected

### Error States
- "Please fill in all fields"
- "Invalid email format"
- "Passwords do not match"
- "Password must be at least 6 characters"
- "Invalid role selected"
- "Oracle ID already exists"
- "Email already exists"
- "Registration failed. Please try again."

### Success State
- "Registration successful! Please login."
- Auto-redirect to login after 2 seconds

---

## 3. Agent Dashboard (`views/dashboard_agent.php`)

**URL**: `index.php?action=dashboard` (when logged in as Agent)

### Visual Layout
```
┌─────────────────────────────────────────────────────────────────────┐
│ Project Tracker     Welcome, John Agent (Oracle ID: AGENT001) [Logout] │
└─────────────────────────────────────────────────────────────────────┘
│                                                                     │
│  Agent Dashboard                             [Agent] (blue badge)  │
│                                                                     │
│  ┌──────────────────────────┐  ┌──────────────────────────┐      │
│  │ Profile Information      │  │ Agent Features           │      │
│  │                          │  │                          │      │
│  │ Username:  John Agent    │  │ ✓ View assigned projects │      │
│  │ Email:     agent1@...    │  │ ✓ Update project status  │      │
│  │ Oracle ID: AGENT001      │  │ ✓ Submit progress reports│      │
│  │ Role:      Agent         │  │ ✓ Access documentation   │      │
│  │                          │  │ ✓ Communicate with...    │      │
│  └──────────────────────────┘  └──────────────────────────┘      │
│                                                                     │
│  ┌───────────────────────────────────────────────────────────┐   │
│  │ Recent Activities                                         │   │
│  │                                                           │   │
│  │ No recent activities to display.                         │   │
│  │                                                           │   │
│  └───────────────────────────────────────────────────────────┘   │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
│            © 2026 Project Tracker. All rights reserved.           │
└─────────────────────────────────────────────────────────────────────┘
```

### Elements

**Navigation Bar** (white background, top):
- "Project Tracker" logo (left, purple)
- Welcome message with username and Oracle ID
- Logout button (right, red)

**Dashboard Header**:
- "Agent Dashboard" title (large, left)
- "Agent" badge (right, blue, rounded)

**Profile Card** (white card, left):
- Title: "Profile Information" (purple)
- Username display
- Email display
- Oracle ID display
- Role display
- All with label-value pairs

**Features Card** (white card, right):
- Title: "Agent Features" (purple)
- Feature list with green checkmarks:
  - View assigned projects
  - Update project status
  - Submit progress reports
  - Access project documentation
  - Communicate with supervisors

**Activities Section** (white card, full-width):
- Title: "Recent Activities"
- Placeholder text (gray, italic)

**Footer** (white background, bottom):
- Copyright notice (centered, gray)

### Color Scheme
- Background: Light gray (#f5f7fa)
- Primary: Purple (#667eea)
- Agent Badge: Blue (#3498db)
- Cards: White with shadow
- Text: Dark gray (#333)
- Links: Purple

---

## 4. Supervisor Dashboard (`views/dashboard_supervisor.php`)

**URL**: `index.php?action=dashboard` (when logged in as Supervisor)

### Visual Layout
```
┌─────────────────────────────────────────────────────────────────────┐
│ Project Tracker  Welcome, Jane Supervisor (Oracle ID: SUPER001) [Logout]│
└─────────────────────────────────────────────────────────────────────┘
│                                                                     │
│  Supervisor Dashboard                [Supervisor] (orange badge)   │
│                                                                     │
│  ┌──────────────────────────┐  ┌──────────────────────────┐      │
│  │ Profile Information      │  │ Supervisor Features      │      │
│  │                          │  │                          │      │
│  │ Username:  Jane Super.   │  │ ✓ Manage all projects    │      │
│  │ Email:     super1@...    │  │ ✓ Assign tasks to agents │      │
│  │ Oracle ID: SUPER001      │  │ ✓ Review submissions     │      │
│  │ Role:      Supervisor    │  │ ✓ Generate reports       │      │
│  │                          │  │ ✓ Approve/reject changes │      │
│  │                          │  │ ✓ Monitor performance    │      │
│  └──────────────────────────┘  └──────────────────────────┘      │
│                                                                     │
│  ┌───────────────────────────────────────────────────────────┐   │
│  │ Team Overview                                             │   │
│  │                                                           │   │
│  │ No team data available yet.                              │   │
│  │                                                           │   │
│  └───────────────────────────────────────────────────────────┘   │
│                                                                     │
│  ┌───────────────────────────────────────────────────────────┐   │
│  │ Project Statistics                                        │   │
│  │                                                           │   │
│  │ No project statistics to display.                        │   │
│  │                                                           │   │
│  └───────────────────────────────────────────────────────────┘   │
│                                                                     │
└─────────────────────────────────────────────────────────────────────┘
│            © 2026 Project Tracker. All rights reserved.           │
└─────────────────────────────────────────────────────────────────────┘
```

### Elements

**Navigation Bar** (white background, top):
- "Project Tracker" logo (left, purple)
- Welcome message with username and Oracle ID
- Logout button (right, red)

**Dashboard Header**:
- "Supervisor Dashboard" title (large, left)
- "Supervisor" badge (right, orange, rounded)

**Profile Card** (white card, left):
- Title: "Profile Information" (purple)
- Username display
- Email display
- Oracle ID display
- Role display
- All with label-value pairs

**Features Card** (white card, right):
- Title: "Supervisor Features" (purple)
- Feature list with green checkmarks:
  - Manage all projects
  - Assign tasks to agents
  - Review agent submissions
  - Generate reports and analytics
  - Approve or reject project changes
  - Monitor team performance

**Team Overview Section** (white card, full-width):
- Title: "Team Overview"
- Placeholder text (gray, italic)

**Statistics Section** (white card, full-width):
- Title: "Project Statistics"
- Placeholder text (gray, italic)

**Footer** (white background, bottom):
- Copyright notice (centered, gray)

### Color Scheme
- Background: Light gray (#f5f7fa)
- Primary: Purple (#667eea)
- Supervisor Badge: Orange (#e67e22)
- Cards: White with shadow
- Text: Dark gray (#333)
- Links: Purple

---

## 5. System Requirements Checker (`check_requirements.php`)

**URL**: `check_requirements.php`

### Visual Layout
```
┌─────────────────────────────────────────────────────┐
│                                                     │
│              [Purple Gradient Background]           │
│                                                     │
│   ┌───────────────────────────────────────────┐   │
│   │                                           │   │
│   │   Project Tracker - System Check          │   │
│   │   Verifying your environment...           │   │
│   │                                           │   │
│   │   ┌─────────────────────────────────┐   │   │
│   │   │ ✓ All checks passed!            │   │   │
│   │   └─────────────────────────────────┘   │   │
│   │                                           │   │
│   │   ✓ PHP Version: PHP 8.1.2 ✓             │   │
│   │   ✓ PDO MySQL Extension: ✓ Available     │   │
│   │   ✓ Session Support: ✓ Available         │   │
│   │   ✓ Database Connection: ✓ Connected     │   │
│   │   ✓ Directory Permissions: ✓ Writable    │   │
│   │   ✓ Required Files: ✓ All files present  │   │
│   │   ✓ Apache mod_rewrite: ✓ Enabled        │   │
│   │                                           │   │
│   │   [Go to Login Page] [Register New User] │   │
│   │                                           │   │
│   └───────────────────────────────────────────┘   │
│                                                     │
└─────────────────────────────────────────────────────┘
```

### Elements
- **Title**: "Project Tracker - System Check"
- **Subtitle**: "Verifying your environment..."
- **Status Summary**: Green box if all pass, red if any fail
- **Check Items**: List of checks with status:
  - Green left border for passed checks
  - Red left border for failed checks
  - Yellow left border for warnings
- **Action Buttons**: 
  - "Go to Login Page" (if all passed)
  - "Register New User" (if all passed)
  - "Refresh Check" (if any failed)
- **Instructions Box**: Blue box with fix instructions (if any failed)

---

## Responsive Design

All pages are responsive and adapt to different screen sizes:

### Desktop (> 768px)
- Two-column grid for dashboard cards
- Full navigation bar
- Spacious padding

### Mobile (< 768px)
- Single column layout
- Stacked navigation elements
- Touch-friendly buttons
- Reduced padding

---

## Color Palette

### Primary Colors
- **Purple Gradient**: #667eea to #764ba2
- **Agent Blue**: #3498db
- **Supervisor Orange**: #e67e22

### UI Colors
- **Success Green**: #27ae60
- **Error Red**: #e74c3c
- **Warning Yellow**: #ffc107
- **Background Gray**: #f5f7fa
- **Text Gray**: #333
- **Light Gray**: #999

### Interactive States
- **Hover**: Slight elevation with shadow
- **Focus**: Purple border
- **Active**: Darker shade

---

## Typography

- **Font Family**: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
- **Headings**: Bold, larger sizes
- **Body**: Regular weight, 14-16px
- **Labels**: Medium weight, 14px
- **Links**: Purple color, underline on hover

---

## Icons & Visual Elements

- **Checkmarks**: ✓ in green for features and successes
- **Asterisks**: * in red for required fields
- **Role Badges**: Rounded pills with role color
- **Alerts**: Colored boxes with border
- **Cards**: White boxes with subtle shadows
- **Gradients**: Background and buttons

---

## User Flow Summary

```
1. First Visit
   → See Login Page
   → Click "Register here"
   
2. Registration
   → Fill form with Oracle ID and role
   → Submit registration
   → See success message
   → Auto-redirect to Login
   
3. Login
   → Enter credentials
   → Submit login
   → Session created
   → Redirect to Dashboard
   
4. Dashboard (Role-Based)
   → Agent sees Agent Dashboard
   → Supervisor sees Supervisor Dashboard
   → View profile and features
   → Access role-specific functionality
   
5. Logout
   → Click Logout button
   → Session destroyed
   → Redirect to Login
```

---

## Accessibility Features

- Clear labels for all inputs
- Descriptive error messages
- Keyboard navigation support
- Proper heading hierarchy
- High contrast text
- Touch-friendly buttons (44px minimum)

---

This visual guide provides a complete overview of how the application looks and feels to end users.
