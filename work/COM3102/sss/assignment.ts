// Settings for the assignment. Do not change the codes below

export const GRADES = ['A', 'B', 'C', 'D', 'F'] as const;
export type GradeType = typeof GRADES[number];

export const GradeToGPA: Record<GradeType, number> = {
  ['A']: 4,
  ['B']: 3,
  ['C']: 2,
  ['D']: 1,
  ['F']: 0,
}

export interface StudentTransscript {
  name: string;
  major?: string;
  results: ModuleResult[];
}

export interface ModuleResult {
  module: string;
  grade: GradeType;
}

export interface DisplayItem {
  text: string;
  gpa: number;
}

export function printResult(result: DisplayItem[]) {
  console.log(
    result.map(
      (r, index) => `#${index+1}: ${r.text} GPA: ${r.gpa.toFixed(2)}`
    ).join('\n')
  );
}

//  Settings for the assignment. Do not change the codes above

// Do not change the declaration of the function, e.g., please keep the export keyword
export function orderStudents(students: StudentTransscript[]):DisplayItem[] {
  /*
    Your codes here
  */
 const Ditems: DisplayItem[]=[];
 students.forEach((student)=>{
  if(student.results.length==0){
    return;
  }
  let gradep =0;
  let pass=0;
  student.results.forEach((result)=>{
    if(result.grade!='F'){
      gradep += GradeToGPA[result.grade];
      pass++
    }
  });
  let gpa=0;
  if(pass!=0){
     gpa=gradep/pass
  }
  let text = student.name;
  if (student.major) {
   text=text+"("+student.major+")"
  }
  Ditems.push({ text, gpa: gpa });
});

  Ditems.sort((a, b) => b.gpa - a.gpa);
  return Ditems;
}

// Sample data and driver below. Feel free to change the codes for your own testing

const student1:StudentTransscript = {
  name: 'Dr. Wong',
  major: 'AHCC',
  results: [
    {module:'COM3102', grade:'A'},
    {module:'COM1000', grade:'A'},
    {module:'COM1001', grade:'A'},
    {module:'COM1002', grade:'A'},
    {module:'COM1003', grade:'A'},
  ]
};

const student2:StudentTransscript = {
  name: 'Ann',
  major: 'BBA',
  results: [
    {module:'BUS1000', grade:'A'},
    {module:'BUS2000', grade:'B'},
    {module:'BUS3000', grade:'B'}    
  ]
};

const student3:StudentTransscript = {
  name: 'Bob',  
  major: 'BA',
  results: []
};

const student4:StudentTransscript = {
  name: 'Cat',  
  results: [
    {module:'MAT1000', grade:'F'},
    {module:'MAT1001', grade:'D'},
    {module:'MAT1002', grade:'B'},    
  ]
};

const students = [student1, student2, student3, student4];

printResult(orderStudents(students));

// console.log(GradeToGPA['A']);
// console.log(GradeToGPA['B']);

/*
  Instruction:
  
  Read the given codes about the data structures for the assignment
  Your task is to implement the function orderStudents

  Specification of orderStudents
  Overview: To sort the students according to their GPAs
  Input: a StudentTransscript object
  Output: a DisplayItem object
  Details:
    * Calculate the GPA of each student. The grade points for A / B / C / D  are 4 / 3 / 2 / 1 respectively. A GradeToGPA object is provided to you for a fast translation from the grade to the numeric grade point.
    * Modules that are failed (F grade) are not counted towards the student's GPA. See Cat's case in the provided sample data.
    * If a student does not have any result, the student is not included in the final list. See Bob's case in the provided sample data.
    * If all modules of a student are failed, his/her GPA is 0.
    * The text property is for displaying the basic information of the student. Use this format: "[Name] ([Major])" (note the space between name and major). See Ann's case in the provided sample data.
    * Major is an optional property. In case major is absent, just put the name to the text property, i.e., "[Name]" (note that there is no space behind the name). See Cat's case in the provided sample data.
    * If two students have the same GPA, you may use any order for them
    * Remember to compare your result against the given sample output to confirm the correctness of your format
  
  Marking:
    * Your codes will be marked by machine using test cases (that are different to the given sample data).
    * Your codes will be read manually for plagiarism detection

*/