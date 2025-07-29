# Troubleshooting: Asset Files Not Loading

If your CSS, JavaScript, or image files are not loading on your WordPress site, the most common cause is **incorrect file permissions**.

## Quick Fix: Check File Permissions

### What to Check
When assets (CSS, JS, images) return **404 errors** even though the files exist in your hosting file manager, it's almost always a permissions issue.

### Required Permissions

| Item Type | Permission | What It Means |
|-----------|------------|---------------|
| **Folders** | `755` | Owner: read/write/execute, Others: read/execute |
| **Files** | `644` | Owner: read/write, Others: read only |

### How to Fix in cPanel

1. **Navigate to your theme folder:**
   ```
   public_html/wp-content/themes/[your-theme-name]/
   ```

2. **Fix folder permissions:**
   - Right-click on your theme folder (the one linked to your GitHub repo)
   - Select "Permissions" 
   - Set to `755`
   - ✅ **Check "Recurse into subdirectories"**
   - Click "Change Permissions"

3. **Fix file permissions:**
   - Go inside your theme folder
   - Select all files (CSS, JS, images)
   - Right-click → "Permissions"
   - Set to `644`

### Test Your Fix

After changing permissions, test by accessing assets directly in your browser:

```
https://yourdomain.com/wp-content/themes/your-theme-name/assets/css/style.css
https://yourdomain.com/wp-content/themes/your-theme-name/assets/images/your-image.jpg
```

If these URLs work, your site assets should now load properly.

### Why This Happens

- Files uploaded via Git/GitHub sometimes inherit restrictive permissions (like `700`)
- Permission `700` means only the file owner can access files
- Web servers need `755` (folders) and `644` (files) to serve content to visitors

### If You Can't Change Permissions

Contact your hosting provider and request they change your theme folder permissions to:
- **Folders:** `755` 
- **Files:** `644`
- **Apply recursively** to all subfolders and files

---

**Pro Tip:** Always verify your file permissions after deploying from GitHub to avoid this issue.