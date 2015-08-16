<?php require_once('../includes/initialize.php'); ?>
<?php confirm_logged_in(); ?>

<?php $layout_context = "admin"; ?>
<?php $active_menu="admin"; ?>
<?php $stylesheets="";  ?>
<?php $fluid_view=true; ?>
<?php $javascript=""; ?>
<?php $incl_message_error=true; ?>
<?php include("../includes/layouts/header_2.php"); ?>
<?php include("../includes/layouts/nav.php"); ?>

<h4 class="text-center"><mark><a href="<?php echo $_SERVER["PHP_SELF"] ?>">Git Version Software </a> </mark><span><a href="http://www.lynda.com/Git-tutorials/Understanding-version-control/100222/111248-4.html">Lynda GIT by Kevin Skoglund</a> </span></h4>

<div id="myheader">
    <ol>
        <li><a href="#config">Config</a></li>
        <li><a href="#starting">Initialize Starting </a></li>
        <li><a href="#log">log</a></li>
        <li><a href="#diff">Diff</a></li>
        <li><a href="#delete">Delete Rename Move</a></li>

        <li><a href="#checkout">Checkout</a></li>
        <li><a href="#gitignore">gitignore file</a></li>


        <li><a href="#branch">Branch</a></li>
        <li><a href="#stash">Stash</a></li>
        <li><a href="#remote">remote</a></li>
        <li><a href="#alias">alias</a></li>
        <li><a href="#ssh">SSH key</a></li>


    </ol>
</div>

<div class="row">
    <div class="col-md-3 box"  >

        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="config"><strong>Configuration</strong></h4>


        GIT

        to see which branch we are cmd prompt in the project dir but windows already includes it
        PS1 is the file where config for command prompt
        <pre>__git_ps1</pre>

        We have 3 git on a system , user and project

        System located in c :git\etc\gitconfig
        <pre>config &ndash;system</pre>
        Project
        <pre>git config</pre>

        User home .gitconfig
        To configure on user we can locate in C:\User\Kamran
    <pre>
    git config &ndash;global user.name  &ldquo;Kamran Nafisspour&rdquo; <br>
    git config &ndash;global user.email  &ldquo;nafisspour@bluewin.ch&rdquo;
    </pre>
        to add in config tell which editor to use and color
    <pre>
    git config &ndash;global core.editor &ldquo;notepad.exe&rdquo;
        git config &ndash;global color.ui true
    </pre>

        to see config
        <pre>git config &ndash;list</pre>
        specific <pre>git config user.name</pre>
        or <pre>git config user.email</pre>

        inside user <pre>.gitconfig</pre>

        to see file content <pre> cat .gitconfig</pre>


        help
    <pre>
    git help
    git help log or man git&ndash;log (unix)
    </pre>
    </div>

    <div class="col-md-5"  >
        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="starting"><strong>Initializing a repository</strong></h4>
        &ndash;ls &ndash;la (Unix) .git or dir (Window)
        Project to start tracking get in folder
        <pre>git init</pre>
        file .git in the project is created
        config file can be used but do not use others

        dot do all or filename in quotes
        <pre> git add .</pre>
        <pre>git commit &ndash;m &ldquo;message here&rdquo;</pre>
        if only modifications not if delete or new file so we can commit without going through stage
        it will take all in working dir
        <pre>git commit &ndash;am &ldquo;message here&rdquo;</pre>
        <hr>
        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="log"><strong>log</strong></h4>

        will show all the commit
        <pre>git log</pre>
        <pre>git log help</pre>
        limit no of commit most recent  in log or expressed in a date
        <pre>git log &ndash;n 5</pre>
        <pre>git log &ndash;&ndash;since=2012-06-15</pre>
        <pre>git log &ndash;&ndash;until=2012-06-15</pre>
        <pre>git log &ndash;&ndash;author=&ldquo;Kamran Nafisspour&rdquo;</pre>
        regular expression
        <pre>git log &ndash;&ndash;grep=&ldquo;init&rdquo;</pre>
        see all logs summarized
        <pre>git log &ndash;&ndash;oneline</pre>

        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="diff"><strong>Diff</strong></h4>

        statut working file - staging - repository
        <pre> git status</pre>
        to see modification in staging before committing
        <pre>git diff</pre>
        to see staged diff  compare with repository
        <pre>git diff &ndash;&ndash;staged</pre>
        see diff in dif format one line
        <pre>git diff &ndash;&ndash;color&ndash;words filename.txt</pre>
        <pre> minus(&ndash;) + shit + s + return  to get full long line</pre>
        <hr>

        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="delete"><strong>Delete</strong></h4>
        Delete file from explorer ,when seeing in staged as delete then to delete in repository
        <pre>git add/rm filename</pre> then we do regular commit
        if we want to delete the file from the folder and adds to stage as delete process and the we do commit after
        <pre>git rm filename.txt</pre>
        rename  if changed from explorer will need to add new and rem, git will figure is a rename and the we commit.
        2nd way ,we can rename from git files and will put it stagged
        <pre>git mv first_file.txt new_file.txt</pre>
        move to other place directory firstdir but you can also rename it at same time
        <pre>git mv first_file.txt firstdir/new_file.txt</pre>

        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="checkout"><strong>checkout</strong></h4>
        so if we want to get a file from repository back to working dir.
        use &ndash;&ndash; will ensure to stay on current branch
        <pre>git checkout &ndash;&ndash; filename.txt </pre>
        to bring back a file modified that is staged not yet committed file and want unstaged.
        the working will still keep the change
        <pre>git reset HEAD filename.txt </pre>
        in repository how to undo changes or commits. possible to change the latest commit
        bring the modified in stage.
        Can be used also if we want to change the message onlyS
        <pre>git commit &ndash;&ndash; amend &ndash;m &ldquo;message here&rdquo; </pre>
        to bring back a version old version of a file do checkout with the SHA 10 first and it
        will bring it into staged and recommit if you want.
        <pre>git checkout  6ae98716b64286eb1 &ndash;&ndash; filename.txt </pre>
        so we could re.commit git commit with message <pre>commit  git commit -m &ldquo;6ae98716b64286eb1 message

here&rdquo;</pre>
        or discard by unstaged reset and then checkout by taking latest version in repository.
        <pre>or unstaged / git reset HEAD filename.txt</pre>
        <pre>checkout / git checkout -- filename.txt </pre>
        if we want to revert a commit take first 10 SHA. note did not work for me failed maybe becs a texteditor

        should pop out
        I needed it to recommit normal. ok for simple revert otherwise use cmd merge eg file moved or renamed
        <pre>git revert f3b8da8c035641a62f67c94ff</pre>
        we can undo recent commit by moving header and start out from there.
        Soft move pointer but not staged and wrk dir use SHA to where ou want to point
        <pre>git reset &ndash;&ndash;soft f3b8da8c035641a62f67c94ff</pre>
        mixed move pointer and changed staged but not wrkg dir.
        <pre>git reset &ndash;&ndash;mixed f3b8da8c035641a62f67c94ff</pre>
        hard reset all including working dir. all the commit afterwards will be lost
        <pre>git reset &ndash;&ndash;hard f3b8da8c035641a62f67c94ff</pre>
        <hr>
        to git remove file from being send to rep n test run   f forces only on unstaged items
        it will remove it from the working dir caution permanent delete
        <pre>git clean &ndash;n</pre>
        <pre>git clean &ndash;f</pre>


        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="gitignore"><strong>gitignore</strong></h4>

        for git to ignore files to be tracked in the repository
        a file .gitignore and ensure we commit the file
        can use regular expression or *.php or negation !index.php (do not ignore)
        ignore a all file in dir assets/videos
        <a href="https://help.github.com/articles/ignoring-files/">github ignore file</a> or
        <a href="https://github.com/github/gitignore">github .gitignore suggestion</a>

        ignore file globally not just a project and we have the file be anywhere. Create as a above in user

        .gitignore_global and all element to exclude  cat file to see
        <pre> git config &ndash;&ndash;global core excludesfiles c:/user/kamran/.gitignore_global  </pre>

        geet git to ignore file before .gitignore was created. so we must untracked.
        it will delete in my repo, leave copy in wrkg dir . takes it off staging process (rm without cached delete

        both)
        <pre>git rm &ndash;&ndash;cached filename.txt</pre>

    </div>
    <div class="col-md-3"  >
        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="branch">Branches</h4>
        to see branches
        <pre>git branch</pre>
        to create branch
        <pre>git branch newbranch</pre>
        to switch branches
        <pre>git checkout branchname</pre>
        to switch and add a branch at the same time
        <pre>git checkout &ndash;b newbranch </pre>
        We can compare branch and tree-ish ^ mean the previous commit of that branch
        <pre>git diff new_feature..shorten_title^</pre>
        And to see branches that hve the latest commit of other branches.
        First checkout in which branch you want to be then
        <pre>git branch &ndash;&ndash;merged</pre>
        to rename a branch &ndash;m or &ndash;&ndash;move
        <pre>git branch &ndash;m oldbranch newbranch</pre>
        to delete branch &ndash;d or &ndash;&ndash;delete. need to be on a another branch to del.
        in case some change uncommitted on branch use capital D
        <pre>git branch &ndash;d branchdelete</pre>


        Now if we finished our branch project and want to merge to a parent.
        so i need to be in the receiver branch to merge so use checkout and type the sending branch
        Ensure we have the clean directory-
        <pre>git merge branchname</pre>

        <pre></pre>

        <pre></pre>

        <pre></pre>

        <pre></pre>


    </div>

</div>

<div class="row">
    <div class="col-md-3 box" >
        <span><a href="#myheader">&laquo;back</a></span><br>
<h4 id="stash"><strong>Stash</strong></h4>
        Stash is file that we can save temporary without to commit and we can save at a later stage
        not part of stagind or repository.
        If we make a change on branch for ex, it save and our repository and wrk directory previous state.

        <pre>git stash save &ldquo;message here&rdquo;  </pre>
        to see stash list will return with stash@{0}
        Stash is available also we switch branch
        <pre>git stash list</pre>
        will show summary change
        <pre>git stash show stash@{0}</pre>
        to see more  p=patch
        <pre>git stash show &ndash;p stash@{0}</pre>
        to retrieve stash and will bring back in wrkg dir
        can use pop or apply
        pop put in wkg dir and remove from stash - apply will keep a copy in stash
        without reference will pull out first one
        <pre>git stash pop stash@{0} </pre>
        to delete a stash
        <pre>git stash drop stash@{0}</pre>
        to delete all stash once. caution it is destructive
        <pre>git stash clear</pre>

</div>
    <div class="col-md-5 box" >

        <span><a href="#myheader">&laquo;back</a></span><br>
        <h4 id="remote"><strong>Github remote <a href="https://github.com/">&ndash;github kamy333</a> </strong></h4>

        <em>push </em> to upload to github creates the same branch in github
        At same time git put a copy locally in a branch  <em>origin/master</em> which will be synchronized with github
        <em>fetch</em> to pull down from github eg other ppl change download go to branch origin/master
        and we can merge it if we want.
        So generally speaking, the process that you go through when you're working with a remote, is that you'll do your commits locally, then you'll fetch the latest from the remote server, get your origin branch in sync, then merge any of the new work you did into what just came down from the server and then push the result back up to the remote server.

        <hr>

        In github create a repository free for public-
        to give a list of all remote
        <pre>git remote</pre>
        with more info
        <pre>git remote &ndash;v</pre>
        to remove a remote + nameof remote
        <pre>git remote rm origin</pre>


        To configure with address shown github https example
        origin is alias and we can use others. info store .git/config
        <pre>git remote add origin https://github.com/kamy333/projectname.git</pre>

        to push into github  can be a branch.  github may change.
        Will need to provide username and password after. Creates a new branch
        &ndash;u to keep have reference with remote , withjot mean we just want to put there
        <pre>git push &ndash;u origin master</pre>
        if you did not use &ndash;u and you want to track it
        <pre>git branch &ndash;&ndash;upstream branchname origin/branchname </pre>

        to see remote branch
        <pre>git branch &ndash;r</pre>

        to see both remote and local
        <pre>git branch &ndash;a</pre>

        to bring down a project github for ex. go to the place you want to download.
        find the link in gihub the path. you can name the directory name at the end eg ikamych if you don't want default.
        &ndash;b if you wanted a branch (in github admin we can specify which branch we want)
        Note by downloading it tracks the remote
        <pre>git clone https://github.com/kamy333/projectname.git ikamych</pre>

        to push a change into remote . after doing all the commit as usual.
        Now this in our master but not in the local copy of remote <em>origin/master</em>
        To check
        <pre>git diff origin/master..master</pre>
        <pre>git push origin master</pre>
        but since it is a trackin branch just use. we can sse then in github and origin/master
        <pre>git push</pre>

        so now if want to see the change but as another user as eg collaborator.
        Let's say I downloaded in another folder. so need to do a fetch to retrieve.
        will bring back master (origin/master) and branch (origin/branchname) if any
        <pre>git fetch origin</pre>
        if we have only only 1 repository.
        Fetch often as it give latest github rep and see if any change was done.
        <pre>git fetch</pre>
to check to repository as in github
        <pre>git log &ndash;&ndash;oneline origin/master</pre>
        <pre>git log &ndash;&ndash;oneline origin/branchname</pre>
        will show remote
        <pre>git branch &ndash;r</pre>
so now if we want to bring the remote origin/master local into our master we need to merge.
        Need to be in the receiver(master) to receive from (origin/master)
        <pre>git merge origin/master</pre>

        We have the possibility to fetch and merge in 1 cmd
        <pre>git pull </pre>

        if there is remote branch create locally and will start tracking
        <pre>git branch branchname origin/branchname</pre>

        reminder create a branch and checkout &ndash;b
        <pre>git branch &ndash;b branchname origin/branchname </pre>

        to delete a remote branch
        <pre>git push origin &ndash;&ndash;delete branchname</pre>

        <span><a href="http://www.lynda.com/Git-tutorials/Enabling-collaboration/100222/111339-4.html"> Enabling collaboration</a> </span>

        </div>
            <div class="col-md-3 box"  >

                <span><a href="#myheader">&laquo;back</a></span><br>
                <h4 id="alias"><strong>Alias</strong></h4>

        use alias if you want to use keyboard shortcut command. It should be set in the global config setting.
                here some example  double quotes if there is space &ldquo; commit -a&rdquo;
                Status
        <pre>git config &ndash;&ndash;global alias.st status</pre>
        checkout
        <pre>git config &ndash;&ndash;global alias.co checkout</pre>
        commit checkin
        <pre>git config &ndash;&ndash;global alias.ci commit</pre>
        branch
        <pre>git config &ndash;&ndash;global alias.br branch</pre>
        <pre>git config &ndash;&ndash;global alias.dfs &ldquo;diff &ndash;&ndash;staged &rdquo </pre>
                <pre>git config &ndash;&ndash;global alias.dfs &ldquo;diff &ndash;&ndash;staged &rdquo; </pre>
                <pre>git config &ndash;&ndash;global alias.logg &ldquo;&ndash;&ndash;graph &ndash;&ndash;decorate &ndash;&ndash;oneline &ndash;&ndash;abbrev&ndash;commit &ndash;&ndash;all  &rdquo;</pre>


                <span><a href="#myheader">&laquo;back</a></span><br>
                <h4 id="ssh"><strong>SSH key</strong></h4>

To have connection to github and not having to type your username and password over and over
<span><a href="https://help.github.com/articles/generating-ssh-keys/">Setting SSH</a> </span>

                <pre></pre>

        <pre></pre>

        <pre></pre>

        <pre></pre>



    </div>

</div>



<div>

<ul>
<li>jeter cig dehors</li>
<li>donner mon vin à ses amis</li>
<li>mes cig</li>
<li>fin de mois sans argent</li>

</ul>
</div>


<?php include("../includes/layouts/footer_2.php"); ?>
