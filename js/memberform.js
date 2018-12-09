   function check_id()
   {
     window.open("check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=200,top=200,width=200,height=200,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("check_nick.php?nick=" + document.member_form.nick.value,
         "NICKcheck",
          "left=200,top=200,width=200,height=60,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      if (!document.member_form.id.value)
      {
          alert("아이디를 입력하세요");
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.password.value)
      {
          alert("비밀번호를 입력하세요");
          document.member_form.password.focus();
          return;
      }

      if (!document.member_form.password_check.value)
      {
          alert("비밀번호확인을 입력하세요");
          document.member_form.password_check.focus();
          return;
      }

      if (!document.member_form.name.value)
      {
          alert("이름을 입력하세요");
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.nick.value)
      {
          alert("닉네임을 입력하세요");
          document.member_form.nick.focus();
          return;
      }


      if (!document.member_form.phone.value)
      {
          alert("휴대폰 번호를 입력하세요");
          document.member_form.phone.focus();
          return;
      }

      if (document.member_form.password.value !=
            document.member_form.password_check.value)
      {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해주세요.");
          document.member_form.password.focus();
          document.member_form.password.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form()
   {
      document.member_form.id.value = "";
      document.member_form.password.value = "";
      document.member_form.password_check.value = "";
      document.member_form.name.value = "";
      document.member_form.nick.value = "";
      document.member_form.phone.value = "";
      document.member_form.email.value = "";
      document.member_form.email.value = "";
      document.member_form.id.focus();

      return;
   }
