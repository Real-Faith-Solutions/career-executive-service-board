  function openPersonalEducationalPermissions() {
    document.getElementById('personal_educational_permissions').classList.remove('hidden');
    document.getElementById('experience_trainings_permissions').classList.add('hidden');
    document.getElementById('personal_others_permissions').classList.add('hidden');
  }

  function openExperienceTrainingsPermissions() {
    document.getElementById('personal_educational_permissions').classList.add('hidden');
    document.getElementById('experience_trainings_permissions').classList.remove('hidden');
    document.getElementById('personal_others_permissions').classList.add('hidden');
  }

  function openOthersPermissions() {
    document.getElementById('personal_educational_permissions').classList.add('hidden');
    document.getElementById('experience_trainings_permissions').classList.add('hidden');
    document.getElementById('personal_others_permissions').classList.remove('hidden');
  }
  
