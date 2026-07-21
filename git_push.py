import subprocess, os, sys

cwd = os.path.abspath('.')

def run(cmd):
    try:
        res = subprocess.run(cmd, cwd=cwd, stdout=subprocess.PIPE, stderr=subprocess.STDOUT, text=True)
        return res.returncode, res.stdout
    except Exception as e:
        return 1, str(e)

rc, branch = run(['git', 'rev-parse', '--abbrev-ref', 'HEAD'])
branch = branch.strip()
print('On branch:', branch)

rc, status = run(['git', 'status', '--porcelain'])
if rc != 0:
    print('git status failed:', status)
    sys.exit(rc)

if not status.strip():
    print('No changes to commit')
    sys.exit(0)

print('Staging changes...')
rc, out = run(['git', 'add', '-A'])
print(out)

print('Committing...')
rc, out = run(['git', 'commit', '-m', 'chore(theme): add block templates, CI workflow, screenshot, metadata'])
print(out)
if rc != 0:
    print('Commit failed')
    sys.exit(rc)

print('Pushing to origin/' + branch + '...')
rc, out = run(['git', 'push', 'origin', branch])
print(out)
if rc != 0:
    print('Push failed')
    sys.exit(rc)

print('Push completed successfully')
